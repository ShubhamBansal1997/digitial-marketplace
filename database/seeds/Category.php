<?php

use Illuminate\Database\Seeder;

class Category extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
        	['category_name' => 'Facebook','category_slug' => 'Facebook'],
        	['category_name' => 'Google','category_slug' => 'Google'],
        	['category_name' => 'Instagram','category_slug' => 'Instagram'],
        	['category_name' => 'Youtube','category_slug' => 'Youtube'],
        	['category_name' => 'Pinterest','category_slug' => 'Pinterest'],
        	['category_name' => 'Twitter','category_slug' => 'Twitter'],
        	['category_name' => 'Fashion Templates','category_slug' => 'Fashion-Templates'],
        	['category_name' => 'Electronics','category_slug' => 'Electronics'],
        	['category_name' => 'Jewellery','category_slug' => 'Jewellery'],
        	['category_name' => 'Real Estate Banners','category_slug' => 'Real-Estate-Banners'],
        	['category_name' => 'Sale Banners','category_slug' => 'Sale-Banners'],
        	['category_name' => 'Web Banners','category_slug' => 'Web-Banners'],
        	['category_name' => 'SEO & Service Ads','category_slug' => 'SEO-&-Service-Ads'],
        	['category_name' => 'PPC Service Ads','category_slug' => 'PPC-Service-Ads'],
        	['category_name' => 'Agency Banners','category_slug' => 'Agency-Banners'],
        	['category_name' => 'Web Design Ads','category_slug' => 'Web-Design-Ads'],
        	['category_name' => 'Google Store Banners','category_slug' => 'Google-Store-Banners'],
        	['category_name' => 'Bloggers Kit','category_slug' => 'Bloggers-Kit'],
        	['category_name' => 'Article Posts','category_slug' => 'Article-Posts'],
        	['category_name' => 'Ebook Covers','category_slug' => 'Ebook-Covers'],
        	['category_name' => 'Quotes Banners','category_slug' => 'Quotes-Banners'],
        	['category_name' => 'Influencer Banners','category_slug' => 'Influencer-Banners'],
        	['category_name' => 'Multi-Purpose Banners','category_slug' => 'Multi-Purpose-Banners'],
        	['category_name' => 'Google Play Store','category_slug' => 'Google-Play-Store'],
        	['category_name' => 'Event Kits','category_slug' => 'Event-Kits'],
        	['category_name' => 'Email Newsletters','category_slug' => 'Email-Newsletters'],
        	['category_name' => 'Presentations','category_slug' => 'Presentations'],
        	['category_name' => 'Mockups','category_slug' => 'Mockups'],
        	['category_name' => 'Flyers','category_slug' => 'Flyers'],
        	['category_name' => 'Resumes','category_slug' => 'Resumes'],
        	['category_name' => 'Business Cards','category_slug' => 'Business-Cards'],
        	['category_name' => 'Stationery','category_slug' => 'Stationery'],
        	['category_name' => 'Sales Sheet','category_slug' => 'Sales-Sheet'],
        	['category_name' => 'Logo Design','category_slug' => 'Logo-Design'],
        	['category_name' => 'Logo Customization','category_slug' => 'Logo-Customization'],
        	['category_name' => 'Website Design','category_slug' => 'Website-Design'],
        	['category_name' => 'Landing Page Design','category_slug' => 'Landing-Page-Design'],
        	['category_name' => 'PSD to HTML','category_slug' => 'PSD-to-HTML'],
        	['category_name' => 'PSD to Wordpress','category_slug' => 'PSD-to-Wordpress'],
        	['category_name' => 'Custom Website Development','category_slug' => 'Custom-Website-Development'],
        	['category_name' => 'Email Newsletter Design','category_slug' => 'Email-Newsletter-Design'],
        	['category_name' => 'Mobile App Design','category_slug' => 'Mobile-App-Design'],
        	['category_name' => 'Icon Design','category_slug' => 'Icon-Design'],
        	['category_name' => 'App Mockups','category_slug' => 'App-Mockups'],
        	['category_name' => 'Video Editing','category_slug' => 'Video-Editing'],
        	['category_name' => 'Explainer Videos','category_slug' => 'Explainer-Videos'],
        	['category_name' => 'Logo Animation','category_slug' => 'Logo-Animation'],
        	['category_name' => 'Animation','category_slug' => 'Animation'],
        	['category_name' => 'After Effects Editing','category_slug' => 'After-Effects-Editing'],
        	['category_name' => 'Social Media Posts','category_slug' => 'Social-Media-Posts'],
        	['category_name' => 'Custom Banner Design','category_slug' => 'Custom-Banner-Design'],
        	['category_name' => 'Ebooks Design','category_slug' => 'Ebooks-Design'],
        	['category_name' => 'Carricature Design','category_slug' => 'Carricature-Design'],
        	['category_name' => 'Poster & Flyer Design','category_slug' => 'Poster-&-Flyer-Design'],
        	['category_name' => 'Brochure Design','category_slug' => 'Brochure-Design'],
        	['category_name' => 'Presentation Design','category_slug' => 'Presentation-Design'],
        	['category_name' => 'Resume Design','category_slug' => 'Resume-Design'],
        	['category_name' => 'T-shirt & Apparel Design','category_slug' => 'T-shirt-&-Apparel-Design'],
        	['category_name' => 'Custom Icon Set Design','category_slug' => 'Custom-Icon-Set-Design'],
        	['category_name' => 'Custom Bulk Orders','category_slug' => 'Custom-Bulk-Orders'],

        ];
        DB::table('categories')->insert($users);
    }
}
