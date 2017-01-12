<?php

class BMEAPI {
    var $version = "1.0";

    var $errorMessage;
    var $errorCode;
    var $apiUrl;
    var $timeout = 300;
    var $chunkSize = 8192;
    var $apiToken;

    /**
     * Connect to the Benchmark Email API for a given list. All BMEAPI calls require login before functioning
     *
     * @param string $username Your Benchmark Email login user name - always required
     * @param string $password Your Benchmark Email login password - always required
     */
    function BMEAPI($username, $password, $apiURL) {
        $this->apiUrl = parse_url($apiURL .  "/?output=php");
        if (isset($GLOBALS["bme_api_token"]) && $GLOBALS["bme_api_token"]!=""){
            $this->apiToken = $GLOBALS["bme_api_token"];
        } else {
            $this->apiToken = $this->invokeMethod("login", array("username" => $username, "password" => $password));
            $GLOBALS["bme_api_token"] = $this->apiToken;
        }
    }

  /**
    * Create a new Subaccount based on the details provided
    *
    * @section Account management methods
    *
    * @example bmeapi_subAccountCreate.php
    *
    * @param Array $accountstruct The array containing the email details.
    *  Array Structure
    *  string email      - Email ID of the Subaccount
    *  string firstname  - Firstname of the Subaccount
    *  string lastname   - Lastname of the Subaccount
    *  string login      - Login of the Subaccount
    *  string password   - Password of the Subaccount
    *  string phone      - Phone No. of the Subaccount
    * @return int        -1 if the creation process failed.
    */
    function subAccountCreate($accountstruct) {
      $params = array();
      $params["accountstruct"] = $accountstruct;
      return $this->invokeMethod("subaccountcreate", $params);
    }

 /**
    * Update Subaccount details
    *
    * @section Account management methods
    *
    * @example bmeapi_subAccountUpdate.php
    *
    * @param Array $accountstruct The array containing the email details.
    *  Array Structure
    *  string email      - Email ID of the Subaccount
    *  string firstname  - Firstname of the Subaccount
    *  string lastname   - Lastname of the Subaccount
    *  string login      - Login of the Subaccount
    *  string password   - Password of the Subaccount
    *  string phone      - Phone No. of the Subaccount
    *  string clientid   - Client ID of the Subaccount, this can be obtain by using the subAccountGetList method
    * @return int        -1 if the updation process failed.
    */
    function subaccountupdate($accountstruct) {
      $params = array();
      $params["accountstruct"] = $accountstruct;
      return $this->invokeMethod("subaccountupdate", $params);
    }

    /**
    * Get the list of SubAccounts
    *
    * @section Account management methods
    *
    * @example subAccountGetList.php
    * @return array Returns an array with the results.
    * Return Array Structure
    * string clientid         - ClientID of the Subaccount.You can use the subaccountupdate method to update this
    * string login            - Login of the Subaccount
    * string firstname        - Firstname of the Subaccount
    * string lastname         - Lastname of the Subaccount
    * string plan_email_limit - Volume allocated
    * string free_mail_sent   - Volume used
    * string active           - Status of the Subaccount
    */
    function subAccountGetList() {
      $params = array();
      return $this->invokeMethod("subaccountgetlist", $params);
    }

  /**
    * Update the status of the Subaccount.
    *
    * @section Account management methods
    *
    * @example bmeapi_subAccountUpdateStatus.php
    *
    * @param string $id The ClientID of the Subaccount for which you need to update the status, you can obtain this by using the subAccountGetList() method.
    * @param string $status The status of the Subaccount, this should be either 0 or 1 .
    */

    function subAccountUpdateStatus($id, $status) {
      $params = array();
      $params["id"] = $id;
      $params["status"] = $status;
      return $this->invokeMethod("subaccountupdatestatus", $params);
    }

    /**
     * Internal function - proxy method for certain XML-RPC calls
     * @param mixed Method to call, with any parameters to pass along
     * @return mixed the result of the call
     */
    function invoke() {
        $params = array();
        return $this->invokeMethod("invoke", $params);
    }

    /**
     * Connect to the server and invoke the requested methods, parsing the result
     */
    function invokeMethod($method, $params) {
        if($method != "login" ) {
          if (!array_key_exists("token", $params)) {
            $params["token"] = $this->apiToken;
          }
        }
        $post_vars = $this->httpBuildQuery($params);
        $content = "POST " . $this->apiUrl["path"] . "?" . $this->apiUrl["query"] . "&method=" . $method . " HTTP/1.0\r\n";
        $content .= "Host: " . $this->apiUrl["host"] . "\r\n";
        $content .= "User-Agent: BMEAPI/" . $this->version ."\r\n";
        $content .= "Content-type: application/x-www-form-urlencoded\r\n";
        $content .= "Content-length: " . strlen($post_vars) . "\r\n";
        $content .= "Connection: close \r\n\r\n";
        $content .= $post_vars;

		if($_GET["debug"] == 1) {
			echo $content;
		}
		
        ob_start();
        $sock = fsockopen($this->apiUrl["host"], 80, $errno, $errstr, $this->timeout);
        if(!$sock) {

            $this->errorMessage = "Could not connect (ERR $errno: $errstr)";
            $this->errorCode = "-1";
            ob_end_clean();
            return false;
        }
        $response = "";
        fwrite($sock, $content);
        while(!feof($sock)) {
            $response .= fread($sock, $this->chunkSize);
        }
        fclose($sock);
        ob_end_clean();

        list($throw, $response) = explode("\r\n\r\n", $response, 2);
        if(ini_get("magic_quotes_runtime")) $response = stripslashes($response);

        $serial = unserialize($response);


        if($response && $serial === false) {
          $response = array("error" => "Error : " . $response, "code" => "-2");
        } else {
          $response = $serial;
        }
        if(is_array($response) && isset($response["error"])) {
            $this->errorMessage = $response["error"];
            $this->errorCode = $response["code"];
            return false;
        }
        return $response;
    }

    /**
     * Re-implement http_build_query for systems that do not already have it
     */
    function httpBuildQuery($params, $key=null) {
        $ret = array();
        foreach((array) $params as $name => $val) {
            $name = urlencode($name);
            if($key !== null) {
                $name = $key . "[" . $name . "]";
            }

            if(is_array($val) || is_object($val)) {
                $ret[] = $this->httpBuildQuery($val, $name);
            } elseif($val !== null) {
                $ret[] = $name . "=" . urlencode($val);
            }
        }
        return implode("&", $ret);
    }




    /**
    * Duplicate an existing Email and return the ID of the newly created Email.
    *   The new email will have the same subject, content, target list as the one being copied.
    *   The newly created email will be saved with the status 'Incomplete'.
    *
    * @section Email Campaign Related Methods
    *
    * @example bmeapi_emailCopy.php
    *
    * @param string $emailID The email ID to copy. To get all the emails, use the emailGet method.
    * @return string Returns the email ID of the newly created email campaign.
    */
    function emailCopy($emailID) {
      $params = array();
      $params["emailID"] = $emailID;
      return $this->invokeMethod("emailCopy", $params);
    }


    /**
    * Create a new Email based on the details provided. Return the ID of the newly created Email.
    *
    * @section Email Campaign Related Methods
    *
    * @example bmeapi_emailCreate.php
    *
    * @param Array $emailDetails The array containing the email details.
    * Array Structure
    *  string fromName - Name displayed as "from" in your contact's in-box
    *  string fromEmail -  Email displayed as "from address" in your contact's in-box
    *  string emailName -  For your personal use; not displayed in your email
    *  string replyEmail - Replies are forwarded to this address
    *  string subject -  Subject line of your email
    *  string templateContent -  The content of email
    *  integer toListID  - The contact list ID to whom this campaign is to be sent to. You can get the contact lists from listGet
    *  string us_address - optional. The Address line in case of a US based sender. Defaults to address information provided in the Client Settings
    *  string us_state - optional. The State in case of a US based sender. Defaults to address information provided in the Client Settings
    *  string us_city -  optional. The City in case of a US based sender. Defaults to address information provided in the Client Settings
    *  string us_zip - optional. The Zip Code in case of a US based sender. Defaults to address information provided in the Client Settings
    *  string intl_address - optional. The Zip Code in case of a non-US based sender. Defaults to address information provided in the Client Settings
    *  bool webpageVersion - optional. Include a link to view a web version of the email. Defaults to false.
    *  string permissionReminderMessage -  optional. A Permission reminder which appears on top of the email. Defaults to blank.
    *  string googleAnalyticsCampaign -  optional. The Google Analytics campaign name. If provided, all links in the email will be enabled for tracking by Google Analytics. Defaults to blank.
    *  string scheduleDate - optional. The date on which the campaign is to be delivered. Defaults to 'Draft'.
    * @return string Returns the email ID of the newly created email campaign.
    */
    function emailCreate($emailDetails)
	{
      $params = array();
      $params["emailDetails"] = $emailDetails;
      return $this->invokeMethod("emailCreate", $params);
	 }

    /**
    * Create a new rss Email based on the details provided. Return the ID of the newly created Email.
    *
    * @section Email Campaign Related Methods
    *
    * @example bmeapi_emailRssCreate.php
    *
    * @param Array $emailDetails The array containing the email details.
    * Array Structure
    *  string fromName - Name displayed as "from" in your contact's in-box
    *  string fromEmail -  Email displayed as "from address" in your contact's in-box
    *  string emailName -  For your personal use; not displayed in your email
    *  string replyEmail - Replies are forwarded to this address
    *  string subject -  Subject line of your email
    *  string templateContent -  The content of email
	   string rssurl - The url for rss feed
    *  integer toListID  - The contact list ID to whom this campaign is to be sent to. You can get the contact lists from listGet
    *  string us_address - optional. The Address line in case of a US based sender. Defaults to address information provided in the Client Settings
    *  string us_state - optional. The State in case of a US based sender. Defaults to address information provided in the Client Settings
    *  string us_city -  optional. The City in case of a US based sender. Defaults to address information provided in the Client Settings
    *  string us_zip - optional. The Zip Code in case of a US based sender. Defaults to address information provided in the Client Settings
    *  string intl_address - optional. The Zip Code in case of a non-US based sender. Defaults to address information provided in the Client Settings
    *  bool webpageVersion - optional. Include a link to view a web version of the email. Defaults to false.
    *  string permissionReminderMessage -  optional. A Permission reminder which appears on top of the email. Defaults to blank.
    *  string googleAnalyticsCampaign -  optional. The Google Analytics campaign name. If provided, all links in the email will be enabled for tracking by Google Analytics. Defaults to blank.
    *  string scheduleDate - optional. The date on which the campaign is to be delivered. Defaults to 'Draft'.
    *  string rssinterval   - optional. Interval for rss campaign, default value is 0 , accepted values are 1 , 7 , 30.
    * @return string Returns the email ID of the newly created email campaign.
    */
	function emailRssCreate($emailDetails)
	{
      $params = array();
      $params["emailDetails"] = $emailDetails;
      return $this->invokeMethod("emailRssCreate", $params);
    }

    /**
    * Delete the Email for given ID. Returns true if the email was deleted.
    *
    * @section Email Campaign Related Methods
    *
    * @example bmeapi_emailDelete.php
    *
    * @param string $emailID The email ID to delete. To get all the emails, use the emailGet method.
    * @return bool Returns true if the campaign was deleted.
    */
    function emailDelete($emailID) {
      $params = array();
      $params["emailID"] = $emailID;
      return $this->invokeMethod("emailDelete", $params);
    }


    /**
    * Get the list of emails using the filter and paging limits, order by the name or date of the email.
    *
    * @section Email Campaign Related Methods
    *
    * @example bmeapi_emailGet.php
    *
    * @param string $filter Show emails where the email name starts with the filter
    * @param string $status Fetch emails matching a status(-1 = All, 0 = Draft, 1 = Scheduled, 2 = Sent)
    * @param integer $pageNumber  Fetch results from the given page number.
    * @param integer $pageSize  Number of results per page.
    * @param string $orderBy  Sort the results based on "name" or "date".
    * @param string $sortOrder  Sort the results in the "asc"ending or "desc"ending order.
    * @return array Returns an array with the results.
    * Return Array Structure
    * integer sequence - The sequence number of the record
    * string id - The ID of the email campaign. To get the details of this campaign, use the emailGetDetail method.
    * string emailName - Name of the email campaign
    * string fromName - The from name that appears in the recipients inbox
    * string subject - The subject line of the email
    * integer toListID - The ID of the target contact list
    * string toListName - The name of the target contact list
    * string status - The status of the email. Can be 'Draft', 'Scheduled', 'Sent', 'Incomplete'
    * string createdDate - The date on which the list was created
    * string modifiedDate - The date on which the list was last updated
    */
    function emailGet($filter, $status, $pageNumber, $pageSize, $orderBy, $sortOrder) {
      $params = array();
      $params["filter"] = $filter;
      $params["status"] = $status;
      $params["pageNumber"] = $pageNumber;
      $params["pageSize"] = $pageSize;
      $params["orderBy"] = $orderBy;
      $params["sortOrder"] = $sortOrder;
      return $this->invokeMethod("emailGet", $params);
    }

	/**
    * Get the list of emails using the filter and paging limits, order by the name or date of the email.
    *
    * @section Email Campaign Related Methods
    *
    * @example bmeapi_emailRssGet.php
    *
    * @param string $filter Show emails where the email name starts with the filter
    * @param string $status Fetch emails matching a status(-1 = All, 0 = Draft, 1 = Scheduled, 2 = Sent)
    * @param integer $pageNumber  Fetch results from the given page number.
    * @param integer $pageSize  Number of results per page.
    * @param string $orderBy  Sort the results based on "name" or "date".
    * @param string $sortOrder  Sort the results in the "asc"ending or "desc"ending order.
    * @return array Returns an array with the results.
    * Return Array Structure
    * integer sequence - The sequence number of the record
    * string id - The ID of the email campaign. To get the details of this campaign, use the emailGetDetail method.
    * string emailName - Name of the email campaign
    * string fromName - The from name that appears in the recipients inbox
    * string subject - The subject line of the email
    * integer toListID - The ID of the target contact list
    * string toListName - The name of the target contact list
    * string status - The status of the email. Can be 'Draft', 'Scheduled', 'Sent', 'Incomplete'
    * string createdDate - The date on which the list was created
    * string modifiedDate - The date on which the list was last updated
    */
    function emailRssGet($filter, $pageNumber, $pageSize, $orderBy, $sortOrder) {
      $params = array();
      $params["filter"] = $filter;
      $params["pageNumber"] = $pageNumber;
      $params["pageSize"] = $pageSize;
      $params["orderBy"] = $orderBy;
      $params["sortOrder"] = $sortOrder;
      return $this->invokeMethod("emailRssGet", $params);
    }
    /**
    * Get all the details for given Email ID.
    *
    * @section Email Campaign Related Methods
    *
    * @example bmeapi_emailGetDetail.php
    *
    * @param string $emailID The email ID to get. To get all the emails, use the emailGet method.
    * @return array Returns an array with the results.
    * Return Array Structure
    * integer sequence - The sequence number of the record
    * string id - The ID of the email campaign. To get the details of this campaign, use the emailGetDetail method.
    * string emailName - Name of the email campaign
    * string fromName - The from name that appears in the recipients inbox
    * string fromEmail -  Email displayed as "from address" in your contact's in-box
    * string replyEmail - Replies are forwarded to this address
    * string subject - The subject line of the email
    * integer toListID - The ID of the target contact list
    * string toListName - The name of the target contact list
    * bool isSegment -  Returns true if a segment has been used as the target
    * string templateContent -  The HTML content of the email
    * string templateText - The Text version of the email
    * string us_address -The Address line in case of a US based sender.
    * string us_state - The State in case of a US based sender.
    * string us_city -  The City in case of a US based sender.
    * string us_zip - The Zip Code in case of a US based sender. Defaults to address information provided in the Client Settings
    * string intl_address - The Address line in case of Outside US-based sender
    * bool webpageVersion - Returns true if a link to view a web version of the email has been set
    * string permissionReminderMessage -  The Permission reminder which appears on top of the email.
    * string googleAnalyticsCampaign -  The Google Analytics campaign name.
    * string status - The status of the email. Can be 'Draft', 'Scheduled', 'Sent', 'Incomplete'
    * string createdDate - The date on which the email was created
    * string modifiedDate - The date on which the email was last updated
    */
    function emailGetDetail($emailID) {
      $params = array();
      $params["emailID"] = $emailID;
      return $this->invokeMethod("emailGetDetail", $params);
    }
/**
    * Get all the details for given rss Email ID.
    *
    * @section Email Campaign Related Methods
    *
    * @example bmeapi_emailRssGetDetail.php
    *
    * @param string $emailID The email ID to get. To get all the emails, use the emailGet method.
    * @return array Returns an array with the results.
    * Return Array Structure
    * integer sequence - The sequence number of the record
    * string id - The ID of the email campaign. To get the details of this campaign, use the emailGetDetail method.
    * string emailName - Name of the email campaign
    * string fromName - The from name that appears in the recipients inbox
    * string fromEmail -  Email displayed as "from address" in your contact's in-box
    * string replyEmail - Replies are forwarded to this address
    * string subject - The subject line of the email
    * integer toListID - The ID of the target contact list
    * string toListName - The name of the target contact list
    * bool isSegment -  Returns true if a segment has been used as the target
    * string templateContent -  The HTML content of the email
    * string templateText - The Text version of the email
    * string us_address -The Address line in case of a US based sender.
    * string us_state - The State in case of a US based sender.
    * string us_city -  The City in case of a US based sender.
    * string us_zip - The Zip Code in case of a US based sender. Defaults to address information provided in the Client Settings
    * string intl_address - The Address line in case of Outside US-based sender
    * bool webpageVersion - Returns true if a link to view a web version of the email has been set
    * string permissionReminderMessage -  The Permission reminder which appears on top of the email.
    * string googleAnalyticsCampaign -  The Google Analytics campaign name.
    * string status - The status of the email. Can be 'Draft', 'Scheduled', 'Sent', 'Incomplete'
    * string createdDate - The date on which the email was created
    * string modifiedDate - The date on which the email was last updated
    * string rssurl - The url for rss feeds
	* string rssinterval - The interval for the rss campaign

    */
    function emailRssGetDetail($emailID) {
      $params = array();
      $params["emailID"] = $emailID;
      return $this->invokeMethod("emailGetDetail", $params);
    }

    /**
    * Schedule an email for delivery for the given date time.
    *
    * @section Email Campaign Related Methods
    *
    * @example bmeapi_emailSchedule.php
    *
    * @param string $emailID The ID of the email campaign to schedule. To get all the emails, use the emailGet method.
    * @param string $scheduleDate The future date on which the email campaign is to be sent.
    * @return bool Returns true if the email campaign was successfully scheduled.
    */
    function emailSchedule($emailID, $scheduleDate) {
      $params = array();
      $params["emailID"] = $emailID;
      $params["scheduleDate"] = $scheduleDate;
      return $this->invokeMethod("emailSchedule", $params);
    }

    /**
    * Schedule an email for delivery for the given date time.
    *
    * @section Email Campaign Related Methods
    *
    * @example bmeapi_emailRssSchedule.php
    *
    * @param string $emailID The ID of the rss email campaign to schedule. To get all the emails, use the emailGet method.
    * @param string $scheduleDate The future date on which the rss email campaign will start
    * @param string $interval The interval in  days on which the campaign will be sent, default valid values are 1 , 7 and 30.
    * @return bool Returns true if the email campaign was successfully scheduled.
    */
    function emailRssSchedule($emailID, $scheduleDate, $interval) {
      $params = array();
      $params["emailID"] = $emailID;
      $params["scheduleDate"] = $scheduleDate;
	  $params["interval"] = $interval;
      return $this->invokeMethod("emailRssSchedule", $params);
    }

    /**
    * Schedule an email for immediate delivery.
    *
    * @section Email Campaign Related Methods
    *
    * @example bmeapi_emailSendNow.php
    *
    * @param string $emailID The ID of the email campaign to schedule. To get all the emails, use the emailGet method.
    * @return bool Returns true if the email campaign was successfully scheduled for immediate delivery.
    */
    function emailSendNow($emailID) {
      $params = array();
      $params["emailID"] = $emailID;
      return $this->invokeMethod("emailSendNow", $params);
    }

    /**
    * Send a test email for the given Email ID
    *
    * @section Email Campaign Related Methods
    *
    * @example bmeapi_emailSendTest.php
    *
    * @param string $emailID The ID of the email campaign to schedule. To get all the emails, use the emailGet method.
    * @param string $testEmail The email address to which the email campaign is to be sent as a test.
    * @return bool Returns true if the email campaign was successfully sent to the test email address.
    */
    function emailSendTest($emailID, $testEmail) {
      $params = array();
      $params["emailID"] = $emailID;
      $params["testEmail"] = $testEmail;
      return $this->invokeMethod("emailSendTest", $params);
    }


   /**
    * Set an email as draft. This would clear its delivery schedule.
    *
    * @section Email Campaign Related Methods
    *
    * @example bmeapi_emailUnSchedule.php
    *
    * @param string $emailID The ID of the email campaign to unschedule. To get all the emails, use the emailGet method.
    * @return bool Returns true if the email campaign was successfully unscheduled.
    */
    function emailUnSchedule($emailID) {
      $params = array();
      $params["emailID"] = $emailID;
      return $this->invokeMethod("emailUnSchedule", $params);
    }

   /**
    * Resend an email campaign to contacts that were added since the campaign was last sent.
    *
    * @section Email Campaign Related Methods
    *
    * @example bmeapi_emailResent.php
    *
    * @param string $emailID The ID of the email campaign to resend. To get all the emails, use the emailGet method.
    * @param string $scheduleDate - the date when the campaign will be resent.
    * @return bool Returns true if the email campaign was successfully Resent.
    */
    function emailResent( $emailID,$scheduleDate )
	{
       $params = array();
       $params["emailID"] = $emailID;
	   $params["scheduleDate"] = $scheduleDate;
       return $this->invokeMethod("emailResent", $params);
    }

   /**
    * Resend an email campaign to list of email addresses
    *
    * @section Email Campaign Related Methods
    *
    * @example bmeapi_emailQuickSend.php
    *
    * @param string $emailID The ID of the email campaign to which the list will be sent. To get all the emails, use the emailGet method.
    * @param string $ListName - the name of the list where the contacts will be stored.
	* @param Array Structure $emails
    *  string email - The email address
    * @param string $scheduleDate - the date when the campaign will be quicksent.
    * @return bool Returns true if the email campaign was successfully quicksent.
    */
    function emailQuickSend( $emailID,$ListName,$emails,$scheduleDate )
	{
      $params = array();
      $params["emailID"]  = $emailID;
	  $params["ListName"] = $ListName;
	  $params["emails"]   = $emails;
	  $params["scheduleDate"] = $scheduleDate;
      return $this->invokeMethod("emailQuickSend", $params);
    }

   /**
    * Create a new Autoresponder based on the details provided. Return the ID of the newly created Autoresponder.
    *
    * @section Email Campaign Related Methods
    *
    * @example bmeapi_autoresponderCreate.php
	*  @param Array Structure $Autoresponder
    *  string autoresponderName    - Name of the autoresponder
    *  string contactListID        - Id of the contact list or segment that will be associated with this autoresponder
	*  bool isSegment              - Whether a segment is associated with this autoresponder
    *  string fromName             - From name used for the autoresponder campaign
    *  string fromEmail            - From email address
    *  bool   permissionReminder   - Whether the permission reminder text would be sent in the mail.
    *  string permissionReminderMessage  - The actual permission reminder message
    *  bool webpageVersion - Returns true if a link to view a web version of the email has been set

    * @return Returns the ID of the newly created Autoresponder..
    */
    function autoresponderCreate( $Autoresponder )
	{
      $params = array();
      $params["Autoresponder"]  = $Autoresponder;
      return $this->invokeMethod("autoresponderCreate", $params);
    }

   /**
    * Update an Autoresponder based on the details provided.
    *
    * @section Email Campaign Related Methods
    *
    *  @example bmeapi_autoresponderUpdate.php
	*  @param string $autoresponderID The Autoresponder ID which needs to be updated.
    *  @param string $status       0 for decativating and 1 for activation

	*  @param Array Structure $Autoresponder
    *  string autoresponderName    - Name of the autoresponder
    *  string fromName             - From name used for the autoresponder campaign
    *  string fromEmail            - From email address
    *  bool   permissionReminder   - Whether the permission reminder text would be sent in the mail.
    *  string permissionReminderMessage  - The actual permission reminder message
    *  bool webpageVersion - Returns true if a link to view a web version of the email has been set

    * @return Returns true if the update is successful.
    */
    function autoresponderUpdate( $autoresponderID , $status , $Autoresponder )
	{
      $params = array();
      $params["autoresponderID"]  = $autoresponderID;
	  $params["status"]           = $status;
	  $params["Autoresponder"]    = $Autoresponder;
      return $this->invokeMethod("autoresponderUpdate", $params);
    }

    /**
    * Delete the Autoresponder for given ID. Returns true if the Autoresponder was deleted.
    *
    * @section Email Campaign Related Methods
    *
    * @example bmeapi_autoresponderDelete.php
    *
    * @param string $autoresponderID The Autoresponder ID to delete. To get all the Autoresponders, use the autoresponderGetList method.
    * @return bool Returns true if the autoresponder campaign was deleted.
    */
    function autoresponderDelete( $autoresponderID )
	{
      $params = array();
      $params["autoresponderID"] = $autoresponderID;
      return $this->invokeMethod("autoresponderDelete", $params);
    }

    /**
    * Create Autoresponder email template and Returns the ID of the newly created Autoresponder email template
    *
    * @section Email Campaign Related Methods
    *
    * @example bmeapi_autoresponderDetailCreate.php
    * @param string $autoresponderID The Autoresponder ID for which we are adding the email.
	*  @param Array Structure $AutoresponderDetail
    *  string subject - The subject line of the email
    *  string templateContent -  The HTML content of the email
    *  string templateText - The Text version of the email
    *  string us_address -The Address line in case of a US based sender.
    *  string us_state - The State in case of a US based sender.
    *  string us_city -  The City in case of a US based sender.
    *  string us_zip - The Zip Code in case of a US based sender. Defaults to address information provided in the Client Settings
    *  string intl_address - The Address line in case of Outside US-based sender
    *  string type - type of the autoresponder -   valid values are 'one off email' , 'annual email' , 'new subscriber email'
	*  string days - no of days after the date of the creation of the Autoresponder when the email is to be sent to the list
    *  string whentosend - when to send the autoresponder  valid values are 'after' , 'before', ignore if this is not applicable
    *  string fieldtocompare - Label of the datecolumn which is used as a reference for 'annual email' or 'one off email' , ignore if this is not applicable
    * @return Returns the ID of the newly created Autoresponder email template.
    */

    function autoresponderDetailCreate(  $autoresponderID  , $AutoresponderDetail )
	{
      $params = array();
	  $params["autoresponderID"]  = $autoresponderID;
      $params["AutoresponderDetail"]  = $AutoresponderDetail;
      return $this->invokeMethod("autoresponderDetailCreate", $params);
    }

    /**
    * Delete the delete the autoresponder email whose id has been specified
    *
    * @section Email Campaign Related Methods
    *
    * @example bmeapi_autoresponderDetailDelete.php
    *
    * @param string $autoresponderID The Autoresponder ID to delete. To get all the Autoresponders, use the autoresponderGetList method.
    * @param string $autoresponderDetailID The detail id of the autoresponder that needs to be deleted
    * @return bool Returns true if the autoresponder campaign was deleted.
    */
    function autoresponderDetailDelete( $autoresponderID , $autoresponderDetailID )
	{
      $params = array();
      $params["autoresponderID"]       = $autoresponderID;
      $params["autoresponderDetailID"] = $autoresponderDetailID;
      return $this->invokeMethod("autoresponderDetailDelete", $params);
    }


   /* get the details of the autoresponder whose id has been specified
    *
    * @section Email Campaign Related Methods
    *
    * @example bmeapi_autoresponderGetDetail.php
    *
    * @param string $autoresponderID The autoresponder ID to get. To get all the autoresponders, use the autoresponderGetList method.
    * @return array Returns an array with the results.

    * Return Array Structure
    * integer sequence - The sequence number of the record
    * string id - The ID of the autoresponder campaign.
    * string autoresponderName - Name of the autoresponder campaign
    * string totalEmails       - no of email templates associated with this autoresponder
    * string fromName - The from name that appears in the recipients inbox
    * string fromEmail -  Email displayed as "from address" in your contact's in-box
    * string status  - Status of the autoresponder
    * string contactListID  - The ID of the  contact list
    * string contactListName - The name of the  contact list
    * bool   isSegment -  Returns true if a segment has been used as the target
    * bool   webpageVersion - Returns true if a link to view a web version of the email has been set
    * string permissionReminderMessage -  The Permission reminder which appears on top of the email.
    * string createdDate - The date on which the email was created
    * string modifiedDate - The date on which the email was last updated
	* Array  emails - array of email templates that are associated with the autoresponder
	  each element of the string array emails has an associated array  with the following elements
	   *  string autoresponderDetailID - The id of the autoresponder email
	   *  string subject               - The subject of the autoresponder email
       *  string type - type of the autoresponder -   valid values are 'one off email' , 'annual email' , 'new subscriber email'
	   *  string days - no of days after the date of the creation of the Autoresponder when the email is to be sent to the list
       *  string whentosend - when to send the autoresponder  valid values are 'after' , 'before', ignore if this is not applicable
       *  string fieldtocompare - Label of the datecolumn which is used as a reference for 'annual email' or 'one off email' , ignore if this is not applicable

    */
    function autoresponderGetDetail($autoresponderID)
	{
      $params = array();
      $params["autoresponderID"] = $autoresponderID;
      return $this->invokeMethod("autoresponderGetDetail", $params);
    }


    /* Get all the details for given AutoresponderID and its coresponding Autoresponder email template .
    *
    * @section Email Campaign Related Methods
    *
    * @example bmeapi_autoresponderGetEmailDetail.php
    *
    * @param string $autoresponderID The autoresponder ID to get. To get all the autoresponders, use the autoresponderGetList method.
    * @param string $autoresponderDetailID The ID of the autoresponder email template
    * @return array Returns an array with the results.

    * Return Array Structure
    * integer sequence - The sequence number of the record
    * string id - The ID of the email campaign. To get the details of this campaign, use the emailGetDetail method.
    * string emailName - Name of the email campaign
    * string fromName - The from name that appears in the recipients inbox
    * string fromEmail -  Email displayed as "from address" in your contact's in-box
    * string replyEmail - Replies are forwarded to this address
    * string subject - The subject line of the email
    * integer toListID - The ID of the target contact list
    * string toListName - The name of the target contact list
    * string templateContent -  The HTML content of the email
    * string templateText - The Text version of the email
    * string us_address -The Address line in case of a US based sender.
    * string us_state - The State in case of a US based sender.
    * string us_city -  The City in case of a US based sender.
    * string us_zip - The Zip Code in case of a US based sender. Defaults to address information provided in the Client Settings
    * string intl_address - The Address line in case of Outside US-based sender
    * bool webpageVersion - Returns true if a link to view a web version of the email has been set
    * string permissionReminderMessage -  The Permission reminder which appears on top of the email.
    * string createdDate - The date on which the email was created
    * string modifiedDate - The date on which the email was last updated
    */

    function autoresponderGetEmailDetail( $autoresponderID , $autoresponderDetailID )
	{
      $params = array();
      $params["autoresponderID"] = $autoresponderID;
	  $params["autoresponderDetailID"] = $autoresponderDetailID;
      return $this->invokeMethod("autoresponderGetEmailDetail", $params);
    }

   /*
   * @example bmeapi_autoresponderGetList.php
    *
    * @param string $filter Show emails where the email name starts with the filter
    * @param integer $pageNumber  Fetch results from the given page number.
    * @param integer $pageSize  Number of results per page.
    * @param string $orderBy  Sort the results based on "name" or "date".
    * @param string $sortOrder  Sort the results in the "asc"ending or "desc"ending order.
    * @return array Returns an array with the results.

    * Return Array Structure
    * integer  sequence - The sequence number of the record
    * string  id - The ID of the autoresponder campaign
    * string  autoresponderName - Name of the autoresponder campaign
    * string  totalEmails - The no of emails associated with the autoresponder
    * string  status - The status of the autoresponder campaign, 1 if its activated, 0 if it is otherwise
    * string  modifiedDate - The date on which the Autoresponder was modified
    */
    function autoresponderGetList( $pageNumber, $pageSize, $orderBy, $filter , $sortOrder )
	{
      $params = array();
      $params["filter"] = $filter;
      $params["pageNumber"] = $pageNumber;
      $params["pageSize"] = $pageSize;
      $params["orderBy"] = $orderBy;
      $params["sortOrder"] = $sortOrder;
      return $this->invokeMethod("autoresponderGetList", $params);
    }

    /**
    * Update an existing email with the given details.
    *
    * @section Email Campaign Related Methods
    *
    * @example bmeapi_emailUpdate.php
    *
    * @param Array $emailDetails The array containing the email details.
    * Array Structure
    *  string id - The email campaign ID to update. You can get the emails from emailGet
    *  string fromName - Name displayed as "from" in your contact's in-box
    *  string fromEmail -  Email displayed as "from address" in your contact's in-box
    *  string emailName -  For your personal use; not displayed in your email
    *  string replyEmail - Replies are forwarded to this address
    *  string subject -  Subject line of your email
    *  string templateContent -  The content of email
    *  integer toListID  - The contact list ID to whom this campaign is to be sent to. You can get the contact lists from listGet
    *  string us_address - optional. The Address line in case of a US based sender. Defaults to address information provided in the Client Settings
    *  string us_state   - optional. The State in case of a US based sender. Defaults to address information provided in the Client Settings
    *  string us_city    - optional. The City in case of a US based sender. Defaults to address information provided in the Client Settings
    *  string us_zip     - optional. The Zip Code in case of a US based sender. Defaults to address information provided in the Client Settings
    *  string intl_address - optional. The Zip Code in case of a non-US based sender. Defaults to address information provided in the Client Settings
    *  bool webpageVersion - optional. Include a link to view a web version of the email. Defaults to false.
    *  string permissionReminderMessage -  optional. A Permission reminder which appears on top of the email. Defaults to blank.
    *  string googleAnalyticsCampaign -  optional. The Google Analytics campaign name. If provided, all links in the email will be enabled for tracking by Google Analytics. Defaults to blank.
    *  string scheduleDate - optional. The date on which the campaign is to be delivered. Defaults to 'Draft'.
    * @return bool Returns true on success
    */
    function emailUpdate($emailDetails) {
      $params = array();
      $params["emailDetails"] = $emailDetails;
      return $this->invokeMethod("emailUpdate", $params);
    }

/**
    * Update an existing email with the given details.
    *
    * @section Email Campaign Related Methods
    *
    * @example bmeapi_emailRssUpdate.php
    *
    * @param Array $emailDetails The array containing the email details.
    * Array Structure
    *  string id - The email campaign ID to update. You can get the emails from emailGet
    *  string fromName - Name displayed as "from" in your contact's in-box
    *  string fromEmail -  Email displayed as "from address" in your contact's in-box
    *  string emailName -  For your personal use; not displayed in your email
    *  string replyEmail - Replies are forwarded to this address
    *  string subject -  Subject line of your email
    *  string templateContent -  The content of email
	*  string rssurl - The url for rss feed
    *  integer toListID  - The contact list ID to whom this campaign is to be sent to. You can get the contact lists from listGet
    *  string us_address - optional. The Address line in case of a US based sender. Defaults to address information provided in the Client Settings
    *  string us_state - optional. The State in case of a US based sender. Defaults to address information provided in the Client Settings
    *  string us_city -  optional. The City in case of a US based sender. Defaults to address information provided in the Client Settings
    *  string us_zip - optional. The Zip Code in case of a US based sender. Defaults to address information provided in the Client Settings
    *  string intl_address - optional. The Zip Code in case of a non-US based sender. Defaults to address information provided in the Client Settings
    *  bool webpageVersion - optional. Include a link to view a web version of the email. Defaults to false.
    *  string permissionReminderMessage -  optional. A Permission reminder which appears on top of the email. Defaults to blank.
    *  string googleAnalyticsCampaign -  optional. The Google Analytics campaign name. If provided, all links in the email will be enabled for tracking by Google Analytics. Defaults to blank.
    *  string scheduleDate - optional. The date on which the campaign is to be delivered. Defaults to 'Draft'.
    *  string rssinterval   - optional. Interval for rss campaign, default value is 0 , accepted values are 1 , 7 , 30.
    * @return bool Returns true on success
    */
    function emailRssUpdate($emailDetails) {
      $params = array();
      $params["emailDetails"] = $emailDetails;
      return $this->invokeMethod("emailRssUpdate", $params);
    }

 	/**
    * Assign Lists to the Email for given ID.
    *
    * @section Email Campaign Related Methods
    *
    * @example bmeapi_emailAssignList.php
    *
    * @param string $emailID The email ID to update. To get all the emails, use the emailGet method.
    * @param array $contacts The array containing the listID / segmentID(s) to assign to the email.
    */
    function emailAssignList($emailID, $contacts) {
      $params = array();
      $params["emailID"] = $emailID;
      $params["contacts"] = $contacts;
      return $this->invokeMethod("emailAssignList", $params);
    }

	/**
    * Adding Multiple Contacts to a Email List and returns batch ID
    *
    * @section Contact List Related Methods
    *
    * @example bmeapi_batchAddContacts.php
    *
    * @param string listid - The contact list ID in which to add contacts. To get all the contact lists, use the listGet method.
    * @param Array Structure contacts    *
    *  string email - The email address
    *  string firstname -  The first name of the contact
    *  string lastname -  The last name of the contact
    * @return string Batch ID for the operation. To get the status of the operation, use the batchGetStatus method.
    */
    function batchAddContacts($listID, $contacts) {
      $params = array();
      $params["listID"] = $listID;
      $params["contacts"] = $contacts;
      return $this->invokeMethod("batchAddContacts", $params);
    }

    /**
	* Get status of the batch contact add operation
	*
	* @section Contact List Related Methods
	*
	* @example bmeapi_batchGetStatus.php
	*
	* @param string listid - The contact list ID in which the contacts were added.
	* @param string batchid - The batch ID returned by the batchAddContacts method.
	* @return string status for the operation. 0 = Pending, 1 = Import Complete, 3 = Pending Approval
	*/
	function batchGetStatus($listID, $batchID) {
	  $params = array();
	  $params["listID"] = $listID;
	  $params["batchID"] = $batchID;
	  return $this->invokeMethod("batchGetStatus", $params);
    }

    /**
    * Add the contact details to the given contact list. Multiple contacts would be added if the details has more than one items.
    *
    * @section Contact List Related Methods
    *
    * @example bmeapi_listAddContacts.php
    *
    * @param string listid - The contact list ID in which to add contacts. To get all the contact lists, use the listGet method.
    * @param Array Structure contacts    *
    *  string email - The email address
    *  string firstname -  The first name of the contact
    *  string lastname -  The last name of the contact
    * @return integer Returns the total number of contacts which were successfully added.
    */
    function listAddContacts($listID, $contacts) {
      $params = array();
      $params["listID"] = $listID;
      $params["contacts"] = $contacts;
      $params["optin"] = 0;
      return $this->invokeMethod("listAddContacts", $params);
    }

    /**
    * Add the contact details to the given contact list. Multiple contacts would be added if the details has more than one items.
    *
    * @section Contact List Related Methods
    *
    * @example bmeapi_listAddContactsOptin.php
    *
    * @param string listid - The contact list ID in which to add contacts. To get all the contact lists, use the listGet method.
    * @param Array Structure contacts    *
    *  string email - The email address
    *  string firstname -  The first name of the contact
    *  string lastname -  The last name of the contact
    * @return integer Returns the total number of contacts which were successfully added.
    */
    function listAddContactsOptin($listID, $contacts, $optin = 0) {
      $params = array();
      $params["listID"] = $listID;
      $params["contacts"] = $contacts;
      $params["optin"] = $optin;
      return $this->invokeMethod("listAddContacts", $params);
    }

    /**
    * Add the contact details using the signup form
    *
    * @section Contact List Related Methods
    *
    * @example bmeapi_listAddContactsForm.php
    *
    * @param string signupformid - The signup form ID used to add contacts. To get all the contact lists, use the listGetSignupForms method.
    * @param Structure contacts
    *  string email - The email address
    *  string firstname -  The first name of the contact
    *  string lastname -  The last name of the contact
    * @return integer Returns if the contact was successfully added.
    */
    function listAddContactsForm($signupformid, $contacts) {
      $params = array();
      $params["signupformid"] = $signupformid;
      $params["contacts"] = $contacts;
      return $this->invokeMethod("listAddContactsForm", $params);
    }

    /**
    * Create a new contact list.
    *
    * @section Contact List Related Methods
    *
    * @example bmeapi_listCreate.php
    *
    * @param string listName - The name of the contact list you want to create.
    * @return string Returns the contact list ID of the newly created list.
    */
    function listCreate($listName) {
      $params = array();
      $params["listName"] = $listName;
      return $this->invokeMethod("listCreate", $params);
    }

    /**
    * Get the contact lists in your account.
    *
    * @section Contact List Related Methods
    *
    * @example bmeapi_listGet.php
    *
    * @param string $filter Show lists where the contact list name starts with the filter
    * @param integer $pageNumber  Fetch results from the given page number.
    * @param integer $pageSize  Number of results per page.
    * @param string $orderBy  Sort the results based on "name" or "date".
    * @param string $sortOrder  Sort the results in the "asc"ending or "desc"ending order.
    * @return array Returns an array with the results.
    * Return Array Structure
    * integer sequence - The sequence number of the record
    * string id - The ID of the contact list. To get the contacts from this list , use the listGetContacts method.
    * string listname - Name of the contact list
    * string contactcount - The number of active contacts in the list
    * string createdDate - The date on which the list was created
    * string modifiedDate - The date on which the list was last updated
    */
    function listGet($filter, $pageNumber, $pageSize, $orderBy, $sortOrder) {
      $params = array();
      $params["filter"] = $filter;
      $params["pageNumber"] = $pageNumber;
      $params["pageSize"] = $pageSize;
      $params["orderBy"] = $orderBy;
      $params["sortOrder"] = $sortOrder;
      return $this->invokeMethod("listGet", $params);
    }

    /**
    * Get the contact details from the contact list
    *
    * @section Contact List Related Methods
    *
    * @example bmeapi_listGetContactDetails.php
    *
    * @param string listID - The contact list ID from which you want to retrieve records. To get the contact lists in your account, use the listGet method.
    * @param string emailAddress - The email address for which details are required
    * @return array Returns an array with the results.
    * Return Array Structure
    * integer sequence - The sequence number of the record
    * string id - The ID of the contact
    * string email - Email Address of the contact
    * string Other Fields - All other fields based on the contact list fields are displayed. The name of the fields will correspond to the field names used when creating the contact list
    */
    function listGetContactDetails($listID, $emailAddress) {
      $params = array();
      $params["listID"] = $listID;
      $params["emailAddress"] = $emailAddress;
      return $this->invokeMethod("listGetContactDetails", $params);
    }


	/**
	* listGetContactFields
	*
	* @section List Related Methods
	*
	* @example bmeapi_listGetContactFields.php
	*
	* @param string $listID
	* Returns Success or failure
	*/
	function listGetContactFields($listID) {
		$params = array();
		$params["listID"] = $listID;
		return $this->invokeMethod("listGetContactFields", $params);
	}

    /**
    * Get the contacts from the contact list.
    *
    * @section Contact List Related Methods
    *
    * @example bmeapi_listGetContacts.php
    *
    * @param string $listID The contact list ID from which you want to retrieve records. To get the contact lists in your account, use the listGet method.
    * @param string $filter Show contacts where the email address contains with the filter
    * @param integer $pageNumber  Fetch results from the given page number.
    * @param integer $pageSize  Number of results per page.
    * @param string $orderBy  Sort the results based on "email" or "date".
    * @param string $sortOrder  Sort the results in the "asc"ending or "desc"ending order.
    * @return array Returns an array with the results.
    * Return Array Structure
    * integer sequence - The sequence number of the record
    * string id - The ID of the contact
    * string email - Email Address of the contact. To get all the details for the contact, use the listGetContactDetails method.
    * string firstname - First name of the contact
    * string middlename - Middle name of the contact
    * string lastname - Last name of the contact
    */
    function listGetContacts($listID, $filter, $pageNumber, $pageSize, $orderBy, $sortOrder) {
      $params = array();
      $params["listID"] = $listID;
      $params["filter"] = $filter;
      $params["pageNumber"] = $pageNumber;
      $params["pageSize"] = $pageSize;
      $params["orderBy"] = $orderBy;
      $params["sortOrder"] = $sortOrder;
      return $this->invokeMethod("listGetContacts", $params);
    }

	/**
    * Get the contacts from the contact list.
    *
    * @section Contact List Related Methods
    *
    * @example listGetContactsAllFields.php
    *
    * @param string $listID The contact list ID from which you want to retrieve records. To get the contact lists in your account, use the listGet method.
    * @param string $filter Show contacts where the email address contains with the filter
    * @param integer $pageNumber  Fetch results from the given page number.
    * @param integer $pageSize  Number of results per page.
    * @param string $orderBy  Sort the results based on "email" or "date".
    * @param string $sortOrder  Sort the results in the "asc"ending or "desc"ending order.
    * @return array Returns an array with the results.
    * Return Array Structure
    * integer sequence - The sequence number of the record
    * string id - The ID of the contact
    * string email - Email Address of the contact. To get all the details for the contact, use the listGetContactDetails method.
    * string firstname - First name of the contact
    * string middlename - Middle name of the contact
    * string lastname - Last name of the contact
    */
    function listGetContactsAllFields($listID, $filter, $pageNumber, $pageSize, $orderBy, $sortOrder) {
      $params = array();
      $params["listID"] = $listID;
      $params["filter"] = $filter;
      $params["pageNumber"] = $pageNumber;
      $params["pageSize"] = $pageSize;
      $params["orderBy"] = $orderBy;
      $params["sortOrder"] = $sortOrder;
      return $this->invokeMethod("listGetContactsAllFields", $params);
    }


    /**
    * Unsubscribe the contacts from the given contact list.
    *
    * @section Contact List Related Methods
    *
    * @example bmeapi_listUnsubscribeContacts.php
    *
    * @param string $listID The contact list ID in which to unsubscrib contacts. To get all the contact lists, use the listGet method.
    * @param array contacts   The string array containing the contact details.
    * @return integer Returns the total number of contacts which are active in the list.
    */
    function listUnsubscribeContacts($listID, $contacts) {
      $params = array();
      $params["listID"] = $listID;
      $params["contacts"] = $contacts;
      return $this->invokeMethod("listUnsubscribeContacts", $params);
    }

    /**
    * Unsubscribe the contacts from the given contact list.
    *
    * @section Contact List Related Methods
    *
    * @example bmeapi_listUpdateContactDetails.php
    *
    * @param string $listID The contact list ID from which you want to retrieve records. To get the contact lists in your account, use the listGet method.
    * @param string $contactID The contact ID which you want to update. To get the contact ID from a list in your account, use the listGetContacts method.
    * @param array contactDetail   The string array containing the contact details.
    * Return Array Structure
    * integer sequence - The sequence number of the record
    * string id - The ID of the contact
    * string email - Email Address of the contact. To get all the details for the contact, use the listGetContactDetails method.
    * string firstname - First name of the contact
    * string middlename - Middle name of the contact
    * string lastname - Last name of the contact
    */
    function listUpdateContactDetails($listID, $contactID, $contactDetail) {
      $params = array();
      $params["listID"] = $listID;
      $params["contactID"] = $contactID;
      $params["contactDetail"] = $contactDetail;
      return $this->invokeMethod("listUpdateContactDetails", $params);
    }

	/**
    * Delete the contact list whose id has been specified
    *
    * @section Contact List Related Methods
    *
    * @example bmeapi_listDelete.php
    *
    * @param string $listID The List ID to delete. To get the contact lists in your account, use the listGet method.
    * @return bool Returns true if the Contact List was deleted.
    */
    function listDelete( $listID)
	{
      $params = array();
      $params["listID"]       = $listID;
      return $this->invokeMethod("listDelete", $params);
    }

    /**
    * Get the signup forms in your account.
    *
    * @section Contact List Related Methods
    *
    * @example listGetSignupForms.php
    *
    * @param integer $pageNumber  Fetch results from the given page number.
    * @param integer $pageSize  Number of results per page.
    * @param string $orderBy  Sort the results based on "name" or "date".
    * @return array Returns an array with the results.
    * Return Array Structure
    * integer sequence - The sequence number of the record
    * string id - The ID of the signup form.
    * string name - Name of the signup form
    * string listname - Name of the contact list
    */
    function listGetSignupForms($pageNumber, $pageSize, $orderBy) {
      $params = array();
      $params["pageNumber"] = $pageNumber;
      $params["pageSize"] = $pageSize;
      $params["orderBy"] = $orderBy;
      return $this->invokeMethod("listGetSignupForms", $params);
    }



    /**
    * Get the segments in your account.
    *
    * @section Segment Related Methods
    *
    * @example bmeapi_segmentGet.php
    *
    * @param string $filter Show lists where the segment name starts with the filter
    * @param integer $pageNumber  Fetch results from the given page number.
    * @param integer $pageSize  Number of results per page.
    * @param string $orderBy  Sort the results based on "name" or "date".
    * @return array Returns an array with the results.
    * Return Array Structure
    * integer sequence - The sequence number of the record
    * string id - The ID of the contact list. To get the contacts from this list , use the listGetContacts method.
    * string segmentname - Name of the segment
    * string listid - ID of the list
    * string listname - Name of the contact list
    * string contactcount - The number of active contacts in the list
    * string createdDate - The date on which the list was created
    * string modifiedDate - The date on which the list was last updated
    */
    function segmentGet($filter, $pageNumber, $pageSize, $orderBy) {
      $params = array();
      $params["filter"] = $filter;
      $params["pageNumber"] = $pageNumber;
      $params["pageSize"] = $pageSize;
      $params["orderBy"] = $orderBy;
      return $this->invokeMethod("segmentGet", $params);
    }

    /**
    * Get the segments in your account.
    *
    * @section Segment Related Methods
    *
    * @example bmeapi_segmentGetDetail.php
    *
    * @param string $segmentID The ID of segment you want to delete
    * @return array Returns an array with the results.
    * Return Array Structure
    * integer sequence - The sequence number of the record
    * string id - The ID of the contact list. To get the contacts from this list , use the listGetContacts method.
    * string segmentname - Name of the segment
    * string listid - ID of the list
    * string listname - Name of the contact list
    * string contactcount - The number of active contacts in the list
    * string createdDate - The date on which the list was created
    * string modifiedDate - The date on which the list was last updated
    */
    function segmentGetDetail($segmentID) {
      $params = array();
      $params["segmentID"] = $segmentID;
      return $this->invokeMethod("segmentGetDetail", $params);
    }

    /**
    * Create  the segments in your account.
    *
    * @section Segment Related Methods
    *
    * @example bmeapi_segmentCreate.php
    *
    * @param string $segmentname The name of segment
    * @param string $description The description of the segment
    * @param integer $listID The list ID on which the segment is created
    * @return array Returns segment ID
    * Return Segment ID
    */
    function segmentCreate($segmentData) {
      $params = array();
      $params["segmentDetail"] = $segmentData;
      return $this->invokeMethod("segmentCreate", $params);
    }

    /**
    * Delete a segment in your account.
    *
    * @section Segment Related Methods
    *
    * @example bmeapi_segmentDelete.php
    *
    * @param string $segmentid The ID of segment you want to delete
    * @return bool Returns true in case the segment is deleted
    */
    function segmentDelete($segmentID) {
      $params = array();
      $params["segmentid"] = $segmentID;
      return $this->invokeMethod("segmentDelete", $params);
    }

    /**
    * Delete a segment criteria in your account.
    *
    * @section Segment Related Methods
    *
    * @example bmeapi_segmentDeleteCriteria.php
    *
    * @param string $segmentid The ID of segment you want to delete the criteria from
    * @param string $criteriaID The ID of criteria you want to delete
    * @return bool Returns true in case the criteria is deleted
    */
    function segmentDeleteCriteria($segmentID, $criteriaID) {
      $params = array();
      $params["segmentid"] = $segmentID;
      $params["criteriaid"] = $criteriaID;
      return $this->invokeMethod("segmentDeleteCriteria", $params);
    }

    /**
    * Get the contacts from the segment.
    *
    * @section Segment List Related Methods
    *
    * @example bmeapi_segmentGetContacts.php
    *
    * @param string $segmentID The segment ID from which you want to retrieve records. To get the segments in your account, use the segmentGet method.
    * @param string $filter Show contacts where the email address contains with the filter
    * @param integer $pageNumber  Fetch results from the given page number.
    * @param integer $pageSize  Number of results per page.
    * @param string $orderBy  Sort the results based on "email" or "date".
    * @param string $sortOrder  Sort the results in the "asc"ending or "desc"ending order.
    * @return array Returns an array with the results.
    * Return Array Structure
    * integer sequence - The sequence number of the record
    * string id - The ID of the contact
    * string email - Email Address of the contact. To get all the details for the contact, use the listGetContactDetails method.
    * string firstname - First name of the contact
    * string middlename - Middle name of the contact
    * string lastname - Last name of the contact
    */
    function segmentGetContacts($segmentID, $filter, $pageNumber, $pageSize, $orderBy, $sortOrder) {
      $params = array();
      $params["segmentID"] = $segmentID;
      $params["filter"] = $filter;
      $params["pageNumber"] = $pageNumber;
      $params["pageSize"] = $pageSize;
      $params["orderBy"] = $orderBy;
      $params["sortOrder"] = $sortOrder;
      return $this->invokeMethod("segmentGetContacts", $params);
    }

    /**
    * Get the contacts from the segment.
    *
    * @section Segment List Related Methods
    *
    * @example bmeapi_segmentGetCriteriaList.php
    *
    * @param string $segmentID The segment ID from which you want to retrieve records. To get the segments in your account, use the segmentGet method.
    * @return array Returns an array with the results.
    * Return Array Structure
    * integer sequence - The sequence number of the record
    * string id - The ID of the contact
    * string field - Email Address of the contact. To get all the details for the contact, use the listGetContactDetails method.
    * string segmentid - First name of the contact
    * string startdate - Middle name of the contact
    * string enddate - Last name of the contact
    * string filtertype - Last name of the contact
    * string filter - Last name of the contact
    */
    function segmentGetCriteriaList($segmentID) {
      $params = array();
      $params["segmentID"] = $segmentID;
      return $this->invokeMethod("segmentGetCriteriaList", $params);
    }

    /**
    * Create a criteria for the segment.
    *
    * @section Segment List Related Methods
    *
    * @example bmeapi_segmentCreateCriteria.php
    *
    * @param string $segmentID - The segment ID for which you want to create the criteria. To get the segments in your account, use the segmentGet method.
    * @param string $field - The field for which you want to create the criteria.
    * @param string $filtertype - The type of filter (starts, ends, contains, equal, not starts, not ends, not contains, not equal, between)
    * @param string $filter - The string to match for the field filter
    * @param string $startDate - The start date (where field is "Subscribed Date")
    * @param string $endDate - The start date (where field is "Subscribed Date" and filtertype = "between")

    * @return string Returns the criteria ID
    */
    function segmentCreateCriteria($segmentID, $fldArr) {
      $params = array();
      $params["segmentID"] = $segmentID;
      $params["segmentCriteria"] = $fldArr;
      return $this->invokeMethod("segmentCreateCriteria", $params);
    }


    /**
    * Get the list of sent campaign using the filter and paging limits, ordered by the name or date of the campaign.
    *
    * @section Report Related Methods
    *
    * @example bmeapi_reportGet.php
    *
    * @param string $filter Show campaigns where the campaign name starts with the filter
    * @param integer $pageNumber  Fetch results from the given page number.
    * @param integer $pageSize  Number of results per page.
    * @param string $orderBy  Sort the results based on "name" or "date".
    * @param string $sortOrder  Sort the results in the "asc"ending or "desc"ending order.
    * @return array Returns an array with the results.
    * Return Array Structure
    * integer sequence - The sequence number of the record
    * string id - The ID of the email campaign
    * string emailName - Name of the email campaign
    * bool isSegment - True if the target for the campaign is a segment
    * integer toListID - The ID of the target contact list ID / segment
    * string toListName - The name of the target contact list ID / segment
    * string status - The status of the email campaign. Can be Sent, Draft, Scheduled or Incomplete
    * string createdDate - The date on which the email campaign was created
    * string scheduleDate - The campaign delivery date
    */
    function reportGet($filter, $pageNumber, $pageSize, $orderBy, $sortOrder) {
      $params = array();
      $params["filter"] = $filter;
      $params["pageNumber"] = $pageNumber;
      $params["pageSize"] = $pageSize;
      $params["orderBy"] = $orderBy;
      $params["sortOrder"] = $sortOrder;
      return $this->invokeMethod("reportGet", $params);
    }

    /**
    * Get the email addresses which bounced in a given campaign,using the paging limits, ordered by the email or date of the bounced record.
    *
    * @section Report Related Methods
    *
    * @example bmeapi_reportGetBounces.php
    *
    * @param string $emailID The email campaign ID for which the bounces are to be fetched. To get the email campaign ID, use the reportGet method.
    * @param integer $pageNumber  Fetch results from the given page number.
    * @param integer $pageSize  Number of results per page.
    * @param string $orderBy  Sort the results based on "name" or "date".
    * @return array Returns an array with the results.
    * Return Array Structure
    * integer sequence - The sequence number of the record
    * string email - The bounced email address
    * string name - Name of the contact
    * string name - Type of bounce. Can be either Soft or Hard bounce.
    */
    function reportGetBounces($emailID, $pageNumber, $pageSize, $orderBy) {
      $params = array();
      $params["emailID"] = $emailID;
      $params["pageNumber"] = $pageNumber;
      $params["pageSize"] = $pageSize;
      $params["orderBy"] = $orderBy;
      return $this->invokeMethod("reportGetBounces", $params);
    }

    /**
    * Get the click URL stats for the given campaign.
    *
    * @section Report Related Methods
    *
    * @example bmeapi_reportGetClicks.php
    *
    * @param string $emailID The email campaign ID for which the click statistics are to be fetched. To get the email campaign ID, use the reportGet method.
    * @return array Returns an array with the results.
    * Return Array Structure
    * integer sequence - The sequence number of the record
    * string URL - The URL which was clicked
    * string clicks - The total number of clicks received by the URL
    * string percent - The percentage of the clicks received by the URL.
    */
    function reportGetClicks($emailID) {
      $params = array();
      $params["emailID"] = $emailID;
      return $this->invokeMethod("reportGetClicks", $params);
    }

	/**
    * Get the link URLS for the given campaign.
    *
    * @section Report Related Methods
    *
    * @example bmeapi_reportGetEmailLinks.php
    *
    * @param string $emailID The email campaign ID for which the link URLS are to be fetched. To get the email campaign ID, use the reportGet method.
    * @return array Returns an array with the results.
    * Return Array Structure
    * integer sequence - The sequence number of the record
    * string URL - The link URL
    */
    function reportGetEmailLinks($emailID) {
      $params = array();
      $params["emailID"] = $emailID;
      return $this->invokeMethod("reportGetEmailLinks", $params);
    }

    /**
    * Get the email addresses which had clicks in a given campaign,using the paging limits.
    *
    * @section Report Related Methods
    *
    * @example bmeapi_reportGetClickEmails.php
    *
    * @param string $emailID  The email campaign ID for which the clicked emails are to be fetched. To get the email campaign ID, use the reportGet method.
    * @param string $ClickURL  The click URL for which the clicked emails are to be fetched.
	* @param integer $pageNumber  Fetch results from the given page number.
    * @param integer $pageSize  Number of results per page.
    * @param string $orderBy  Sort the results based on "name" or "date".
    * @param string $sortOrder  Sort the results in the "asc"ending or "desc"ending order.
    * @return array Returns an array with the results.
    * Return Array Structure
    * integer sequence - The sequence number of the record
    * string email - The opened email address
    * string name - Name of the contact
    * string logdate - Date on which the open was logged.
    */
    function reportGetClickEmails($emailID, $ClickURL, $pageNumber, $pageSize, $orderBy, $sortOrder) {
      $params = array();
      $params["emailID"] = $emailID;
	  $params["clickURL"] = $ClickURL;
      $params["pageNumber"] = $pageNumber;
      $params["pageSize"] = $pageSize;
      $params["orderBy"] = $orderBy;
      $params["sortOrder"] = $sortOrder;
      return $this->invokeMethod("reportGetClickEmails", $params);
    }


    /**
    * Get the email addresses to which the given campaign was forwarded,using the paging limits, ordered by the email or date of the forwarded record.
    *
    * @section Report Related Methods
    *
    * @example bmeapi_reportGetForwards.php
    *
    * @param string $emailID  The email campaign ID for which the forwards are to be fetched. To get the email campaign ID, use the reportGet method.
    * @param integer $pageNumber  Fetch results from the given page number.
    * @param integer $pageSize  Number of results per page.
    * @param string $orderBy  Sort the results based on "name" or "date".
    * @param string $sortOrder  Sort the results in the "asc"ending or "desc"ending order.
    * @return array Returns an array with the results.
    * Return Array Structure
    * integer sequence - The sequence number of the record
    * string email - The forwarded email address
    * string name - Name of the contact
    * string logdate - The date on which it was forwarded
    */
    function reportGetForwards($emailID, $pageNumber, $pageSize, $orderBy, $sortOrder) {
      $params = array();
      $params["emailID"] = $emailID;
      $params["pageNumber"] = $pageNumber;
      $params["pageSize"] = $pageSize;
      $params["orderBy"] = $orderBy;
      $params["sortOrder"] = $sortOrder;
      return $this->invokeMethod("reportGetForwards", $params);
    }

    /**
    * Get the email addresses which hard bounced in a given campaign,using the paging limits, ordered by the email or date of the bounced record.
    *
    * @section Report Related Methods
    *
    * @example bmeapi_reportGetHardBounces.php
    *
    * @param string $emailID  The email campaign ID for which the hard bounces are to be fetched. To get the email campaign ID, use the reportGet method.
    * @param integer $pageNumber  Fetch results from the given page number.
    * @param integer $pageSize  Number of results per page.
    * @param string $orderBy  Sort the results based on "name" or "date".
    * @param string $sortOrder  Sort the results in the "asc"ending or "desc"ending order.
    * @return array Returns an array with the results.
    * Return Array Structure
    * integer sequence - The sequence number of the record
    * string email - The forwarded email address
    * string name - Name of the contact
    * string type - Type of bounce. Hard Bounce.
    */
    function reportGetHardBounces($emailID, $pageNumber, $pageSize, $orderBy, $sortOrder) {
      $params = array();
      $params["emailID"] = $emailID;
      $params["pageNumber"] = $pageNumber;
      $params["pageSize"] = $pageSize;
      $params["orderBy"] = $orderBy;
      $params["sortOrder"] = $sortOrder;
      return $this->invokeMethod("reportGetHardBounces", $params);
    }

    /**
    * Get the email addresses which soft bounced in a given campaign,using the paging limits, ordered by the email or date of the bounced record.
    *
    * @section Report Related Methods
    *
    * @example bmeapi_reportGetSoftBounces.php
    *
    * @param string $emailID  The email campaign ID for which the soft bounces are to be fetched. To get the email campaign ID, use the reportGet method.
    * @param integer $pageNumber  Fetch results from the given page number.
    * @param integer $pageSize  Number of results per page.
    * @param string $orderBy  Sort the results based on "name" or "date".
    * @param string $sortOrder  Sort the results in the "asc"ending or "desc"ending order.
    * @return array Returns an array with the results.
    * Return Array Structure
    * integer sequence - The sequence number of the record
    * string email - The forwarded email address
    * string name - Name of the contact
    * string type - Type of bounce. Hard Bounce.
    */
    function reportGetSoftBounces($emailID, $pageNumber, $pageSize, $orderBy, $sortOrder) {
      $params = array();
      $params["emailID"] = $emailID;
      $params["pageNumber"] = $pageNumber;
      $params["pageSize"] = $pageSize;
      $params["orderBy"] = $orderBy;
      $params["sortOrder"] = $sortOrder;
      return $this->invokeMethod("reportGetSoftBounces", $params);
    }

    /**
    * Get the email addresses which were opened in a given campaign,using the paging limits, ordered by the email or date of the opened record.
    *
    * @section Report Related Methods
    *
    * @example bmeapi_reportGetOpens.php
    *
    * @param string $emailID  The email campaign ID for which the opens are to be fetched. To get the email campaign ID, use the reportGet method.
    * @param integer $pageNumber  Fetch results from the given page number.
    * @param integer $pageSize  Number of results per page.
    * @param string $orderBy  Sort the results based on "name" or "date".
    * @param string $sortOrder  Sort the results in the "asc"ending or "desc"ending order.
    * @return array Returns an array with the results.
    * Return Array Structure
    * integer sequence - The sequence number of the record
    * string email - The opened email address
    * string name - Name of the contact
    * string logdate - Date on which the open was logged.
    */
    function reportGetOpens($emailID, $pageNumber, $pageSize, $orderBy, $sortOrder) {
      $params = array();
      $params["emailID"] = $emailID;
      $params["pageNumber"] = $pageNumber;
      $params["pageSize"] = $pageSize;
      $params["orderBy"] = $orderBy;
      $params["sortOrder"] = $sortOrder;
      return $this->invokeMethod("reportGetOpens", $params);
    }

 /**
    * Get the email addresses which were neither opened nor bounced in a given campaign,using the paging limits, ordered by the email or date of the opened record.
    *
    * @section Report Related Methods
    *
    * @example bmeapi_reportGetUnopens.php
    *
    * @param string $emailID  The email campaign ID for which the unopens are to be fetched. To get the email campaign ID, use the reportGet method.
    * @param integer $pageNumber  Fetch results from the given page number.
    * @param integer $pageSize  Number of results per page.
    * @param string $orderBy  Sort the results based on "name" or "date".
    * @param string $sortOrder  Sort the results in the "asc"ending or "desc"ending order.
    * @return array Returns an array with the results.
    * Return Array Structure
    * integer sequence - The sequence number of the record
    * string email - The unopened email address
    */
    function reportGetUnopens($emailID, $pageNumber, $pageSize, $orderBy, $sortOrder) {
      $params = array();
      $params["emailID"] = $emailID;
      $params["pageNumber"] = $pageNumber;
      $params["pageSize"] = $pageSize;
      $params["orderBy"] = $orderBy;
      $params["sortOrder"] = $sortOrder;
      return $this->invokeMethod("reportGetUnopens", $params);
    }
    /**
    * Get the email addresses which unsubscribed in a given campaign,using the paging limits, ordered by the email or date of the unsubscribe record.
    *
    * @section Report Related Methods
    *
    * @example bmeapi_reportGetUnsubscribes.php
    *
    * @param string $emailID  The email campaign ID for which the unsubscribes are to be fetched. To get the email campaign ID, use the reportGet method.
    * @param integer $pageNumber  Fetch results from the given page number.
    * @param integer $pageSize  Number of results per page.
    * @param string $orderBy  Sort the results based on "name" or "date".
    * @param string $sortOrder  Sort the results in the "asc"ending or "desc"ending order.
    * @return array Returns an array with the results.
    * Return Array Structure
    * integer sequence - The sequence number of the record
    * string email - The unsubscribed email address
    * string name - Name of the contact
    * string logdate - Date on which the unsubscribe was logged.
    */
    function reportGetUnsubscribes($emailID, $pageNumber, $pageSize, $orderBy, $sortOrder) {
      $params = array();
      $params["emailID"] = $emailID;
      $params["pageNumber"] = $pageNumber;
      $params["pageSize"] = $pageSize;
      $params["orderBy"] = $orderBy;
      $params["sortOrder"] = $sortOrder;
      return $this->invokeMethod("reportGetUnsubscribes", $params);
    }

    /**
    * Get the email statistics for a campaign
    *
    * @section Report Related Methods
    *
    * @example bmeapi_reportGetSummary.php
    *
    * @param string $emailID  The email campaign ID for which the summary statistics are to be fetched. To get the email campaign ID, use the reportGet method.
    * @return array Returns an array with the results.
    * Return Array Structure
    * integer sequence - The sequence number of the record
    * string email - The unsubscribed email address
    * string name - Name of the contact
    * string logdate - Date on which the unsubscribe was logged.
    */
    function reportGetSummary($emailID) {
      $params = array();
      $params["emailID"] = $emailID;
      return $this->invokeMethod("reportGetSummary", $params);
    }

    /**
    * Get the list of emails the client has sent for confirmation
    *
    * @section Client Related Methods
    *
    * @example bmeapi_GetConfirmEmailList.php
    *
    * @return array Returns an array with the results.
    * Return Array Structure
    * integer sequence     - The sequence number of the record
    * integer id           - Unique identifier of the record
    * string email         - The unsubscribed email address
    * integer confirmed    - Whether the client has been verified or not
    * string createddate   - Date on which the record was created
	* string modifieddate  - Date on which the record was modified
    */
	function confirmEmailList()
	{
	   $params = array();
	   return $this->invokeMethod("confirmEmailList", $params);
	}
    /**
    * Add a token for the user.
    *
    * @section Client Related Methods
    *
    * @example bmeapi_AddConfirmEmail.php
    *
    * @param string $targetEmailID  List of email addresses to be verified
    * @return string  Returns "" if the emails are added else it returns the list of emails that were not added.
    */
     function confirmEmailAdd( $targetEmailID )
	{
	   $params = array();
	   $params["targetEmailID"] = $targetEmailID;
	   return $this->invokeMethod("confirmEmailAdd", $params);
	}
    /**
    * Add a token for the user.
    *
    * @section Security Related Methods
    *
    * @example bmeapi_tokenAdd.php
    *
    * @param string $userName  Your Benchmark Email user name
    * @param string $password  Your Benchmark Email password
    * @param string $token  Enter your own token. Should be atleast 6 characters long. To delete an existing token use the tokenDelete method.
    * @return bool  Returns true if the token was set.
    */
    function tokenAdd($userName, $password, $token) {
      $params = array();
      $params["userName"] = $userName;
      $params["password"] = $password;
      $params["token"] = $token;
      return $this->invokeMethod("tokenAdd", $params);
    }

    /**
    * Delete an existing token for the user.
    *
    * @section Security Related Methods
    *
    * @example bmeapi_tokenDelete.php
    *
    * @param string $userName  Your Benchmark Email user name
    * @param string $password  Your Benchmark Email password
    * @param string $token  Your existing token. You can get a list of your valid tokens using tokenGet.
    * @return bool  Returns true if the token was deleted.
    */
    function tokenDelete($userName, $password, $token) {
      $params = array();
      $params["userName"] = $userName;
      $params["password"] = $password;
      $params["token"] = $token;
      return $this->invokeMethod("tokenDelete", $params);
    }


    /**
    * Fetch all tokens for the user.
    *
    * @section Security Related Methods
    *
    * @example bmeapi_tokenGet.php
    *
    * @param string $userName  Your Benchmark Email user name
    * @param string $password  Your Benchmark Email password
    * @return array Returns Returns a string array with all the active tokens of the user. To add new tokens use the tokenAdd method.
    */
    function tokenGet($userName, $password) {
      $params = array();
      $params["userName"] = $userName;
      $params["password"] = $password;
      return $this->invokeMethod("tokenGet", $params);
    }

	 /**
    * Add the contact details to the given contact list. Multiple contacts would be added if the details has more than one items.
    *
    * @section Contact List Related Methods
    *
    * @example bmeapi_listAddContacts.php
    *
    * @param string listid - The contact list ID in which to add contacts. To get all the contact lists, use the listGet method.
    * @param Array Structure contacts    *
    *  string email - The email address
    *  string firstname -  The first name of the contact
    *  string lastname -  The last name of the contact
    * @return integer Returns the total number of contacts which were successfully added.
    */
    function listAddContactsRetID($listID, $contacts) {
      $params = array();
      $params["listID"] = $listID;
      $params["contacts"] = $contacts;
      $params["optin"] = $optin;
      return $this->invokeMethod("listAddContactsRetID", $params);
    }


	/**
    * Create a new Webhook based on the details provided. Return the ID of the newly created Webhook.
    *
    * @section Webhook Related Methods
    *
    * @example bmeapi_webhookCreate.php
    *
    * @param Array $webhookDetails The array containing the email details.
    * Array Structure
	* string contact_list_id - The contact list ID to whom this webhook is to be add. You can get the contact lists from listGet
	* string subscribes	- Use TRUE/FALSE or YES/NO or 1/0 value for "Subscribe" type of updates
	* string unsubscribes -	Use TRUE/FALSE or YES/NO or 1/0 value for "Unsubscribe" type of updates
	* string profile_updates - Use TRUE/FALSE or YES/NO or 1/0 value for "Profile Updates" type of updates
	* string cleaned_address - Use TRUE/FALSE or YES/NO or 1/0 value for "Cleaned Address" type of updates
	* string email_changed	- Use TRUE/FALSE or YES/NO or 1/0 value for "Email Changed" type of updates
    * @return string Returns the webhook ID of the newly created webhook campaign.
    */
	function webhookCreate($webhookDetails)
	{
		$params = array();
		$params["webhookDetails"] = $webhookDetails;
		return $this->invokeMethod("webhookCreate", $params);
	}


	/**
    * Update an existing webhook with the given details.
    *
    * @section Webhook Related Methods
    *
    * @example bmeapi_webhookUpdate.php
    *
    * @param Array $webhookDetails The array containing the email details.
    * Array Structure
    * string contact_list_id - The contact list ID to whom this webhook is to be add. You can get the contact lists from listGet
	* string subscribes	- Use TRUE/FALSE or YES/NO or 1/0 value for "Subscribe" type of updates
	* string unsubscribes -	Use TRUE/FALSE or YES/NO or 1/0 value for "Unsubscribe" type of updates
	* string profile_updates - Use TRUE/FALSE or YES/NO or 1/0 value for "Profile Updates" type of updates
	* string cleaned_address - Use TRUE/FALSE or YES/NO or 1/0 value for "Cleaned Address" type of updates
	* string email_changed	- Use TRUE/FALSE or YES/NO or 1/0 value for "Email Changed" type of updates
    * @return bool Returns true on success
    */
	function webhookUpdate($webhookDetails)
	{
		$params = array();
		$params["webhookDetails"] = $webhookDetails;
		return $this->invokeMethod("webhookUpdate", $params);
	}
	/**
    * Delete the Webhook for given ID. Returns true if the email was deleted.
    *
    * @section Webhook Related Methods
    *
    * @example bmeapi_webhookDelete.php
    *
    * @param string $webhookID The webhook ID to delete. To get all the webhooks, use the webhookGet method.
    * @return bool Returns true if the webhook was deleted.
    */
	function webhookDelete($webhookID) {
		$params = array();
		$params["webhookID"] = $webhookID;
		return $this->invokeMethod("webhookDelete", $params);
	}
	/**
    * Get the list of webhook.
    *
    * @section Webhook Related Methods
    *
    * @example bmeapi_webhookGet.php
    *
    * @param string $listID
    * @return array Returns an array with the results.
    * Return Array Structure
    * integer sequence	The sequence number of the record
	* string id	The ID of the webhook.
	* string url	URL (Uniform resource locator) of the webhook
	* string subscribes	TRUE or FALSE 'Subscribes' update Type of Webhook.
	* string unsubscribes	TRUE or FALSE 'Unsubscribes' update Type of Webhook.
	* integer profile_updates	TRUE or FALSE 'Profile Updates' update Type of Webhook.
	* string email_changed	TRUE or FALSE 'Email Changed' update Type of Webhook.
	* string cleaned_address	TRUE or FALSE 'Cleaned Address' update Type of Webhook.'
	* string createdDate	The date on which the webhook was created
	* string modifiedDate	The date on which the webhook was last updated
    */
	function webhookGet($ContactListID) {
		$params = array();
		$params["ContactListID"] = $ContactListID;
		return $this->invokeMethod("webhookGet", $params);
	}

	function autoresponderDetailHistoryDelete( $autoresponderID,$autoResponderDetailID,$email )
	{
      $params = array();
      $params["autoresponderID"]  		  = $autoresponderID;
	  $params["autoresponderDetailID"]    = $autoResponderDetailID;
	  $params["email"]    				  = $email;
      return $this->invokeMethod("autoresponderDetailHistoryDelete", $params);
    }


	/**
	    * Get the list of events using the filter and paging limits
	    *
	    * @section Event Related Methods
	    *
	    * @example bmeapi_eventGetList.php
	    *
	    * @param string $filtertype Show events where the event name starts with the filter
	    * @param string $filterdetail
	    * @param integer $pageNumber  Fetch results from the given page number.
	    * @param integer $pageSize  Number of results per page.
	    * @param string $orderBy  Sort the results based on "name" or "date".
	    * @param string $sortOrder  Sort the results in the "asc"ending or "desc"ending order.
	    * @return array Returns an array with the results.
	    * Return Array Structure
	    * integer sequence - The sequence number of the record
	    * string eventid -
	    * string eventname -
	    * string status -
	    * string sold -
	    * integer attendeemax -
	    * string startdate -
	    * string enddate -
	    * string repeat -
	    * string timezone -
	    */
	    function eventGetList($filtertype, $filterdetail, $pageNumber, $pageSize, $orderBy, $sortOrder) {
	      $params = array();
	      $params["filtertype"] = $filtertype;
	      $params["filterdetail"] = $filterdetail;
	      $params["pageNumber"] = $pageNumber;
	      $params["pageSize"] = $pageSize;
	      $params["orderBy"] = $orderBy;
	      $params["sortOrder"] = $sortOrder;
	      return $this->invokeMethod("eventGetList", $params);
	    }
	/**
	    * Get the list of events using the filter and paging limits
	    *
	    * @section Event Related Methods
	    *
	    * @example bmeapi_eventGet.php
	    *
	    * @param string $eventid Show details of a particular event

	    * @return array Returns an array with the results.
	    * Return Array Structure
	    * integer sequence - The sequence number of the record

	    */
	    function eventGet($eventid) {
	      $params = array();
	      $params["eventid"] = $eventid;
	      return $this->invokeMethod("eventGet", $params);
	    }

	/**
	    * Get the list of events using the filter and paging limits
	    *
	    * @section Event Related Methods
	    *
	    * @example bmeapi_eventGetTicketType.php
	    *
	    * @param string $eventid Show details of a particular event

	    * @return array Returns an array with the results.
	    * Return Array Structure
	    * integer sequence - The sequence number of the record
	    * string id -
	    * string label -
	    * string price -
	    * string order -
	    * integer absorb -
	    */
	    function eventGetTicketType($eventid) {
	      $params = array();
	      $params["eventid"] = $eventid;
	      return $this->invokeMethod("eventGetTicketType", $params);
	    }

	/**
	    * Get the list of events using the filter and paging limits
	    *
	    * @section Event Related Methods
	    *
	    * @example bmeapi_eventUpdatePage.php
	    *
	    * @param string $categoryID
	    * @param string $filter
	    * @param string $lang

	    * @return array Returns an array with the results.
	    * Return Array Structure
	    * integer sequence - The sequence number of the record
	    * string id -
	    * string label -
	    * string price -
	    * string order -
	    * integer absorb -
	    */
	    function eventTemplateGetList($categoryID, $filter, $lang) {
	      $params = array();
	      $params["categoryID"] = $categoryID;
	      $params["filter"] = $filter;
	      $params["lang"] = $lang;
	      return $this->invokeMethod("eventTemplateGetList", $params);
	    }

	/**
	    * Get the list of events using the filter and paging limits
	    *
	    * @section Event Related Methods
	    *
	    * @example bmeapi_eventUpdatePage.php
	    *
	    * @param string $eventID
	    * @param string $templateID
	    * @param string $content
	    * @param string $css
	    * @param string $csscode

	    * @return array Returns an array with the results.
	    * Return Array Structure


	    */
	    function eventUpdatePage($eventID, $templateID, $content, $css, $csscode ) {
	      $params = array();
	      $params["eventID"] = $eventID;
	      $params["templateID"] = $templateID;
	      $params["content"] = $content;
	      $params["css"] = $css;
	      $params["csscode"] = $csscode;
	      return $this->invokeMethod("eventUpdatePage", $params);
	    }

	/**
	    * Get the list of events using the filter and paging limits
	    *
	    * @section Event Related Methods
	    *
	    * @example bmeapi_ticketGetList.php
	    *
	    * @param string $eventID
	    * @param string $filtertype  -The filter you want to apply when fetching the events
	    * @param string $dateID
	    * @param string $filterdetail  - The filter detail you want to apply when fetching the events
		* @param integer $pageNumber  Fetch results from the given page number.
	    * @param integer $pageSize  Number of results per page.
	    * @param string $orderBy  Sort the results based on "name" or "date".
	    * @param string $sortOrder  Sort the results in the "asc"ending or "desc"ending order.

	    * @return array Returns an array with the results.
	    * Return Array Structure


	    */
	    function ticketGetList($eventID, $filtertype, $dateID, $filterdetail, $pageNumber, $pageSize, $orderBy, $sortOrder ) {
	      $params = array();
	      $params["eventID"] = $eventID;
	      $params["filtertype"] = $filtertype;
	      $params["dateID"] = $dateID;
	      $params["filterdetail"] = $filterdetail;
	      $params["pageNumber"] = $pageNumber;
		  $params["pageSize"] = $pageSize;
		  $params["orderBy"] = $orderBy;
	      $params["sortOrder"] = $sortOrder;

	      return $this->invokeMethod("ticketGetList", $params);
	    }
	/**
	    * Get the list of events using the filter and paging limits
	    *
	    * @section Event Related Methods
	    *
	    * @example bmeapi_ticketGetByID.php
	    *
	    * @param string $eventID
	    * @param string $ticketID  -The filter you want to apply when fetching the events
	    * @return array Returns an array with the results.
	    * Return Array Structure
	    * integer sequence - The sequence number of the record
		* ticketitemID
		* ticketID
		* eventID
		* eventfeeID
		* ticketqty
		* checkinqty
		* price
		* feelabel
		* status
		* discountamt
		* discountperc
		* charges
		* firstname
		* lastname
		* email
		*/
	    function ticketGetByID($eventID, $ticketID ) {
	      $params = array();
	      $params["eventID"] = $eventID;
	      $params["ticketID"] = $ticketID;

	      return $this->invokeMethod("ticketGetByID", $params);
	    }
	/**
	    * Get the list of events using the filter and paging limits
	    *
	    * @section Event Related Methods
	    *
	    * @example bmeapi_attendeeCheckIn.php
	    *
	    * @param string $eventID
	    * @param string $ticketitemID  -The filter you want to apply when fetching the events
	    * Return true or false

		*/
	    function attendeeCheckIn($eventID, $ticketitemID ) {
	      $params = array();
	      $params["eventID"] = $eventID;
	      $params["ticketitemID"] = $ticketitemID;

	      return $this->invokeMethod("attendeeCheckIn", $params);
	    }
	/**
	    * Get the list of events using the filter and paging limits
	    *
	    * @section Event Related Methods
	    *
	    * @example bmeapi_eventGetAttendeeEmailPreview.php
	    *
	    * @param string $eventID
	    * @param string $emailID  -The filter you want to apply when fetching the events
	    * @return array Returns an array with the results.
	    * Return Array Structure

		*/
	    function eventGetAttendeeEmailPreview($eventID, $ticketID ) {
	      $params = array();
	      $params["eventID"] = $eventID;
	      $params["emailID"] = $emailID;

	      return $this->invokeMethod("eventGetAttendeeEmailPreview", $params);
	    }
	/**
	    * Get event invite contact list
	    *
	    * @section Event Related Methods
	    *
	    * @example bmeapi_eventGetInviteContactList.php
	    *
	    * @param string $eventID
	    * @param string $emailID  -The filter you want to apply when fetching the events
	    * @param string $reportType
	    * @param string $filter
		*/
	    function eventGetInviteContactList($eventID, $emailID , $reportType, $filter,  $pageNumber, $pageSize, $orderBy, $sortOrder ) {
	      $params = array();
	      $params["eventID"] = $eventID;
	      $params["emailID"] = $emailID;
		  $params["reportType"] = $reportType;
	      $params["filter"] = $filter;
	      $params["pageNumber"] = $pageNumber;
		  $params["pageSize"] = $pageSize;
          $params["orderBy"] = $orderBy;
	      $params["sortOrder"] = $sortOrder;
	      return $this->invokeMethod("eventGetInviteContactList", $params);
	    }
	/**
	    * Event Comment Show
	    *
	    * @section Event Related Methods
	    *
	    * @example bmeapi_eventCommentShow.php
	    *
	    * @param string $eventID
	    * @param string $PostID
	    * @param string $show
		*/

	    function eventCommentShow($EventID, $PostID, $show) {
	      $params = array();
	      $params["EventID"] = $EventID;
	      $params["PostID"] = $PostID;
		  $params["show"] = $show;
	      return $this->invokeMethod("eventCommentShow", $params);
	    }
	/**
	    * Get the FB Events
	    *
	    * @section Event Related Methods
	    *
	    * @example bmeapi_eventGetFBEvents.php
	    *
	    * @param string $TokenSecret - The FB TokenSecret
	    * @param string $SN - The FB ScreenName
		*/

	    function eventGetFBEvents($TokenSecret, $SN) {
	      $params = array();
	      $params["TokenSecret"] = $TokenSecret;
	      $params["SN"] = $SN;
	      return $this->invokeMethod("eventGetFBEvents", $params);
	    }
	/**
	    * Get the FB Pages
	    *
	    * @section Event Related Methods
	    *
	    * @example bmeapi_eventGetFBPages.php
	    *
	    * @param string $TokenSecret - The FB TokenSecret
	    * @param string $SN - The FB ScreenName
	    * @param string $ID	- The FB ID
		*/

	    function eventGetFBPages($TokenSecret, $SN , $ID) {
	      $params = array();
	      $params["TokenSecret"] = $TokenSecret;
	      $params["SN"] = $SN;
	      $params["ID"] = $ID;
	      return $this->invokeMethod("eventGetFBPages", $params);
	    }
	/**
	    * Post the event comment
	    *
	    * @section Event Related Methods
	    *
	    * @example bmeapi_eventPostComment.php
	    *
	    * @param string $EventID Show events where the event name starts with the filter
	    * @param string $AccountType
	    * @param string $ParentPostID
	    * @param string $PostID
	    * @param string $Message
	    * @param string $ProfileID
	    * @param string $ProfileName
	    * @param string $ProfileImage
	    * @return array Returns an array with the results.
	    * Returns posted comment ID
	    */

	    function eventPostComment($EventID, $AccountType, $ParentPostID, $PostID, $Message, $ProfileID, $ProfileName, $ProfileImage) {
	      $params = array();
	      $params["EventID"] = $EventID;
	      $params["AccountType"] = $AccountType;
	      $params["ParentPostID"] = $ParentPostID;
	      $params["PostID"] = $PostID;
	      $params["Message"] = $Message;
	      $params["ProfileID"] = $ProfileID;
	      $params["ProfileName"] = $ProfileName;
	      $params["ProfileImage"] = $ProfileImage;
	      return $this->invokeMethod("eventPostComment", $params);
	    }
	/**
	    * Post the Event Going Detail
	    *
	    * @section Event Related Methods
	    *
	    * @example bmeapi_eventPostGoing.php
	    *
	    * @param string $EventID Show events where the event name starts with the filter
	    * @param string $AccountType
	    * @param string $ParentPostID  Fetch results from the given page number.
	    * @param string $PostID  Number of results per page.
	    * @param string $Message  Sort the results based on "name" or "date".
	    * @param string $ProfileID  Sort the results in the "asc"ending or "desc"ending order.

	    * @return array Returns an array with the results.
	    * ID
	    * CODE
	    */

	    function eventPostGoing($EventID, $AccountType, $ProfileID, $ProfileName, $ProfileImage) {
	      $params = array();
	      $params["EventID"] = $EventID;
	      $params["AccountType"] = $AccountType;
	      $params["ProfileID"] = $ProfileID;
	      $params["ProfileName"] = $ProfileName;
	      $params["ProfileImage"] = $ProfileImage;
	      return $this->invokeMethod("eventPostGoing", $params);
	    }
	/**
	    * Set the event refund
	    *
	    * @section Event Related Methods
	    *
	    * @example bmeapi_eventRefund.php
	    *
	    * @param string $eventID
	    * @param string $orderID
	    * Returns 1 on successfull refund else -1
		*/

	    function eventRefund($eventID, $orderID) {
	      $params = array();
	      $params["eventID"] = $eventID;
	      $params["orderID"] = $orderID;
	      return $this->invokeMethod("eventRefund", $params);
	    }
	/**
	    * Set the event Ticket Item refund
	    *
	    * @section Event Related Methods
	    *
	    * @example bmeapi_eventTicketItemRefund.php
	    *
	    * @param string $eventID
	    * @param string $ticketitemID
	    * Returns 1 on successfull refund else -1
		*/

	    function eventTicketItemRefund($eventID, $ticketitemID) {
	      $params = array();
	      $params["eventID"] = $eventID;
	      $params["ticketitemID"] = $ticketitemID;
	      return $this->invokeMethod("eventTicketItemRefund", $params);
	    }
	/**
	    * Set the event refund
	    *
	    * @section Event Related Methods
	    *
	    * @example bmeapi_eventResendTicket.php
	    *
	    * @param string $eventID
	    * @param string $orderID
	    * Returns 1 on successfull refund else -1
		*/

	    function eventResendTicket($eventID, $orderID) {
	      $params = array();
	      $params["eventID"] = $eventID;
	      $params["orderID"] = $orderID;
	      return $this->invokeMethod("eventResendTicket", $params);
	    }
	/**
	    * Copy the event
	    *
	    * @section Event Related Methods
	    *
	    * @example bmeapi_eventCopy.php
	    *
	    * @param string $eventID
	    * @param string $eventName
	    * Returns 1 on successfull copy else -1
		*/

	    function eventCopy($eventID, $eventName) {
	      $params = array();
	      $params["eventID"] = $eventID;
	      $params["eventName"] = $eventName;
	      return $this->invokeMethod("eventCopy", $params);
	    }
	/**
	    * Get the event Ticket
	    *
	    * @section Event Related Methods
	    *
	    * @example bmeapi_attendeeCheckOut.php
	    *
	    * @param string $eventID
	    * @param string $ticketitemID  -The filter you want to apply when fetching the events
	    * Return true or false

		*/
	    function attendeeCheckOut($eventID, $ticketitemID ) {
	      $params = array();
	      $params["eventID"] = $eventID;
	      $params["ticketitemID"] = $ticketitemID;

	      return $this->invokeMethod("attendeeCheckOut", $params);
	    }
 	/**
	    * Update the invite for the event
	    *
	    * @section Event Related Methods
	    *
	    * @example bmeapi_eventInviteCampaignUpdate.php
	    *
	    * @param string $eventID Show events where the event name starts with the filter
	    * @param string $emailID
	    * @param integer $content
	    * @param integer $contentRaw
	    * @param string $address
	    * @param string $city
	    * @param string $state
	    * @param string $zip
	    * @param string $intlAddress
	    * @param string $isIntl
		* @param string $textVersion
	    * @param string $templateID
	    * @param string $senderName
		* @param string $replyEmail
		* @param string $subject
		* @param string $listIDs
	    * Return true or false

	    */
	    function eventInviteCampaignUpdate($eventID, $emailID, $content, $contentRaw, $address, $city ,$state, $zip, $intlAddress, $isIntl, $textVersion, $templateID , $senderName, $replyEmail, $subject, $listIDs) {
	      $params = array();
	      $params["eventID"] = $eventID;
	      $params["emailID"] = $emailID;
	      $params["content"] = $content;
	      $params["contentRaw"] = $contentRaw;
	      $params["address"] = $address;
	      $params["city"] = $city;
	      $params["state"] = $state;
		  $params["zip"] = $zip;
		  $params["intlAddress"] = $intlAddress;
		  $params["isIntl"] = $isIntl;
		  $params["textVersion"] = $textVersion;
	      $params["templateID"] = $templateID;
	      $params["senderName"] = $senderName;
		  $params["replyEmail"] = $replyEmail;
		  $params["subject"] = $subject;
	      $params["listIDs"] = $listIDs;

	      return $this->invokeMethod("eventInviteCampaignUpdate", $params);
	    }

	/**
	    * Set the Event Order Pay Status
	    *
	    * @section Event Related Methods
	    *
	    * @example bmeapi_eventUpdatePayStatus.php
	    *
	    * @param string $EventID
	    * @param string $orderid
	    * @param int	$status
	    * Returns the Pay status updated or not

		*/
	    function eventUpdatePayStatus($EventID, $orderid ,$status) {
	      $params = array();
	      $params["EventID"] = $EventID;
	      $params["orderid"] = $orderid;
	      $params["status"] = $status;

	      return $this->invokeMethod("eventUpdatePayStatus", $params);
	    }

	/**
	    * Set the Event Order Pay Status
	    *
	    * @section Event Related Methods
	    *
	    * @example bmeapi_eventUpdateTicketItemPayStatus.php
	    *
	    * @param string $EventID
	    * @param string $TicketItemID
	    * @param int	$status
	    * Returns the Pay status updated or not

		*/
	    function eventUpdateTicketItemPayStatus($EventID, $TicketItemID ,$status) {
	      $params = array();
	      $params["EventID"] = $EventID;
	      $params["TicketItemID"] = $TicketItemID;
	      $params["status"] = $status;

	      return $this->invokeMethod("eventUpdateTicketItemPayStatus", $params);
	    }
	/**
	    * Update the event Url
	    *
	    * @section Event Related Methods
	    *
	    * @example bmeapi_eventUpdateUrl.php
	    *
	    * @param string $eventID
	    * @param string $EventURL
	    * Returns

		*/
	    function eventUpdateUrl($eventID, $EventURL ) {
	      $params = array();
	      $params["eventID"] = $eventID;
	      $params["EventURL"] = $EventURL;
	      return $this->invokeMethod("eventUpdateUrl", $params);
	    }
	/**
	    * Update the Paypal Email
	    *
	    * @section Event Related Methods
	    *
	    * @example bmeapi_eventUpdatePaypalEmail.php
	    *
	    * @param string $EmailID
	    * @param string $OldEmailID
	    * Returns the Paypal Email updated or not

		*/
	    function eventUpdatePaypalEmail($EmailID, $OldEmailID ) {
	      $params = array();
	      $params["EmailID"] = $EmailID;
	      $params["OldEmailID"] = $OldEmailID;
	      return $this->invokeMethod("eventUpdatePaypalEmail", $params);
	    }
	/**
	    * Update the Google Merchant
	    *
	    * @section Event Related Methods
	    *
	    * @example bmeapi_eventUpdateEventGoogleMerchant.php
	    *
	    * @param string $GoogleMID
	    * @param string $GoogleMKEY
	    * @param string $OldGoogleMID
	    * @param string $OldGoogleMKEY
	    * Returns the Google Merchant updated or not

		*/
	    function eventUpdateEventGoogleMerchant($GoogleMID, $GoogleMKEY, $OldGoogleMID, $OldGoogleMKEY) {
	      $params = array();
	      $params["GoogleMID"] = $GoogleMID;
	      $params["GoogleMKEY"] = $GoogleMKEY;
	      $params["OldGoogleMID"] = $OldGoogleMID;
	      $params["OldGoogleMKEY"] = $OldGoogleMKEY;
	      return $this->invokeMethod("eventUpdateEventGoogleMerchant", $params);
	    }
	/**
	    * Set the FB Events
	    *
	    * @section Event Related Methods
	    *
	    * @example bmeapi_eventSetFBToken.php
	    *
	    * @param string $TokenSecret - The FB TokenSecret
	    * @param string $SN - The FB ScreenName
	    * @param string $ID - The FB ScreenName
		*/

	    function eventSetFBToken($TokenSecret, $SN, $ID) {
	      $params = array();
	      $params["TokenSecret"] = $TokenSecret;
	      $params["SN"] = $SN;
	      $params["ID"] = $ID;
	      return $this->invokeMethod("eventSetFBToken", $params);
	    }
	/**
	    * Set the event feedback
	    *
	    * @section Event Related Methods
	    *
	    * @example bmeapi_eventSetFeedback.php
	    *
	    * @param string $eventID
	    * @param string $ClientID
	    * @param string $name
	    * @param string $email
	    * @param string $message
		*/

	    function eventSetFeedback($eventID, $ClientID, $name, $email, $message) {
	      $params = array();
	      $params["eventID"] = $eventID;
	      $params["ClientID"] = $ClientID;
	      $params["name"] = $name;
	      $params["email"] = $email;
	      $params["message"] = $message;
	      return $this->invokeMethod("eventSetFeedback", $params);
	    }
	/**
	    * Set the event Share
	    *
	    * @section Event Related Methods
	    *
	    * @example bmeapi_eventSetShare.php
	    *
	    * @param string $eventID
	    * @param string $ClientID
	    * @param string $name
	    * @param string $email
	    * @param string $message
	    * @param string $subject
	    * @param string $toemail
		*/

	    function eventSetShare($eventID, $ClientID, $name, $email, $message, $subject, $toemail) {
	      $params = array();
	      $params["eventID"] = $eventID;
	      $params["ClientID"] = $ClientID;
	      $params["name"] = $name;
	      $params["email"] = $email;
	      $params["message"] = $message;
	      $params["subject"] = $subject;
	      $params["toemail"] = $toemail;
	      return $this->invokeMethod("eventSetShare", $params);
	    }
	/**
	    * Post the event on Facebook
	    *
	    * @section Event Related Methods
	    *
	    * @example bmeapi_eventCreateFBEvent.php
	    *
	    * @param string $EventID
	    * @param string $PageID  -The filter you want to apply when fetching the events
	    * @param string $PageName
	    * @param string $PageToken
	    * @param string $Eventname
	    * @param string $StartTime
	    * @param string $Location
	    * @param string $Description
		*/
	    function eventCreateFBEvent($EventID, $PageID , $PageName, $PageToken,  $Eventname, $StartTime, $Location, $Description ) {
	      $params = array();
	      $params["EventID"] = $EventID;
	      $params["PageID"] = $PageID;
		  $params["PageName"] = $PageName;
	      $params["PageToken"] = $PageToken;
	      $params["Eventname"] = $Eventname;
		  $params["StartTime"] = $StartTime;
          $params["Location"] = $Location;
	      $params["Description"] = $Description;
	      return $this->invokeMethod("eventCreateFBEvent", $params);
	    }
	/**
	    * Post the event on Facebook
	    *
	    * @section Event Related Methods
	    *
	    * @example bmeapi_eventUpdateFBEvent.php
	    *
	    * @param string $EventID
	    * @param string $StartTime
	    * @param string $Location
	    * @param string $Description
		*/
	    function eventUpdateFBEvent($EventID, $StartTime, $Location, $Description ) {
	      $params = array();
	      $params["EventID"] = $EventID;
		  $params["StartTime"] = $StartTime;
          $params["Location"] = $Location;
	      $params["Description"] = $Description;
	      return $this->invokeMethod("eventUpdateFBEvent", $params);
	    }
	/**
	    * Cancel the event on Facebook
	    *
	    * @section Event Related Methods
	    *
	    * @example bmeapi_eventCancelFBEvent.php
	    *
	    * @param string $EventID
		*/
	    function eventCancelFBEvent($EventID ) {
	      $params = array();
	      $params["EventID"] = $EventID;
	      return $this->invokeMethod("eventCancelFBEvent", $params);
	    }
	/**
	    * eventValidatePayPalEmail
	    *
	    * @section Event Related Methods
	    *
	    * @example bmeapi_eventValidatePayPalEmail.php
	    *
	    * @param string $Email
	    * Returns Success or failure
		*/
	    function eventValidatePayPalEmail($Email ) {
	      $params = array();
	      $params["Email"] = $Email;
	      return $this->invokeMethod("eventValidatePayPalEmail", $params);
	    }

	/**
	    * listSearchContacts
	    *
	    * @section Contact Related Methods
	    *
	    * @example bmeapi_listSearchContacts.php
	    *
	    * @param string $Email
	    * Returns Success or failure
		*/
		function listSearchContacts($emailID) {
		  $params = array();
		  $params["emailID"] = $emailID;
		  return $this->invokeMethod("listSearchContacts", $params);
		}

	/**
	    * listGetCount
	    *
	    * @section List Count Related Methods
	    *
	    * @example bmeapi_listGetCount.php
	    *
	    * @param string $token
	    * @param string $filter
	    * Returns the number of contact lists.
		*/
		function listGetCount($filter) {
		  $params = array();
		  $params["filter"] = $filter;
		  return $this->invokeMethod("listGetCount", $params);
		}


}

?>