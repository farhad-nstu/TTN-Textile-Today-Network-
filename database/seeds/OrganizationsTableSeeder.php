<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrganizationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('organizations')->insert([

            [
              'name' => 'Ahsanullah University',
              'short_details' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
              'website' => 'http://www.aust.edu/',
              'phone' => '0700000000000',
              'fax' => '+44 161 999 8888',
              'email' => 'ahsanullah@tt.com',
              'address' => '141 & 142, Love Road, Dhaka 1208',
              'company_logo' => 'https://jobs.textiletoday.com.bd/wp-content/uploads/2019/12/AUST-96x96.png',
              'status' => '10'
            ],
            [
              'name' => 'UPL',
              'short_details' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
              'website' => 'craft.co',
              'phone' => '01917-733741',
              'fax' => '+44 161 999 8888',
              'email' => 'rahman28@gmail.com',
              'address' => 'Red Crescent Building, 61 Motijheel C/A, Dhaka 1000',
              'company_logo' => 'https://secure.gravatar.com/avatar/dac56c51d3f567c6e3d1b960f6ce4f36?s=96&d=mm&r=g',
              'status' => '10'
            ],
            [
              'name' => 'Robintex Group',
              'short_details' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
              'website' => 'robintex.com',
              'phone' => '01917-733741',
              'fax' => '+44 161 999 8888',
              'email' => 'admin-ho@robintexbd.com',
              'address' => 'Dhaka, Bangladesh',
              'company_logo' => 'https://jobs.textiletoday.com.bd/wp-content/uploads/2019/07/ROBINTEX-GROUP-161-96x96.png',
              'status' => '10'
            ],
            [
              'name' => 'BUFT',
              'short_details' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
              'website' => 'http://buft.edu.bd/',
              'phone' => '',
              'fax' => '+44 161 999 8888',
              'email' => 'info@buft.edu.bd',
              'address' => 'Turag Dhaka, 1230',
              'company_logo' => 'https://jobs.textiletoday.com.bd/wp-content/uploads/2019/06/buft-96x96.png',
              'status' => '10'
            ],
            [
              'name' => 'S.F. Denim Apparels Ltd',
              'short_details' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
              'website' => 'sfdenim.com',
              'phone' => '02-8851256',
              'fax' => '+44 161 999 8888',
              'email' => 'hr2.ho@sfdenim.com',
              'address' => '225, Tejgaon I/A (2nd Floor) Tejgaon, Dhaka-1208, Bir Uttam Mir Shawkat Sarak, Dhaka 1208',
              'company_logo' => 'https://jobs.textiletoday.com.bd/wp-content/uploads/2019/06/0-2-96x96.png',
              'status' => '10'
            ],
            [
              'name' => 'Sinha Knit & Denims Ltd',
              'short_details' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
              'website' => 'sinhaknit.com',
              'phone' => '02-8851256',
              'fax' => '+44 161 999 8888',
              'email' => 'sinhadenims@gmail.com',
              'address' => 'Plot 102, Tenguri, zirani bazaar,, Savar Union',
              'company_logo' => 'https://jobs.textiletoday.com.bd/wp-content/uploads/2019/06/sinha-96x96.jpg',
              'status' => '10'
            ],
            [
              'name' => 'Jamaluddin Textiles (Pvt.) Ltd.',
              'short_details' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
              'website' => 'jamaltextile.bd.com',
              'phone' => '02-8851256',
              'fax' => '+44 161 999 8888',
              'email' => 'shahriar@jamaluddingroup.com',
              'address' => 'Madanpur, N1, Bandar, N1',
              'company_logo' => 'https://jobs.textiletoday.com.bd/wp-content/uploads/2019/06/ja-96x96.png',
              'status' => '10'
            ],
            [
              'name' => 'Global Touch',
              'short_details' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
              'website' => 'globaltech.bd.com',
              'phone' => '02-8851256',
              'fax' => '+44 161 999 8888',
              'email' => 'info@globalapptouch.com',
              'address' => 'house 34 Rd -10, Dhaka 1230',
              'company_logo' => 'https://jobs.textiletoday.com.bd/wp-content/uploads/2019/06/GLOBAL-TOUCH-LOGO-1-1-96x96.png',
              'status' => '10'
            ],
            [
              'name' => 'Azim Group',
              'short_details' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
              'website' => 'https://www.azimgroup.com/',
              'phone' => '02-885125612',
              'fax' => '+44 161 999 8888',
              'email' => 'zimgroup@gmail.com',
              'address' => 'Scout Bhaban, VIP Rd, Dhaka 1205',
              'company_logo' => 'https://jobs.textiletoday.com.bd/wp-content/uploads/2019/06/azimgroup_20170218100052_342-96x96.jpg',
              'status' => '10'
            ],
            [
              'name' => 'NASSA GROUP',
              'short_details' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
              'website' => 'nassa.com.bd',
              'phone' => '02-8819126',
              'fax' => '+44 161 999 8888',
              'email' => 'careers@nassagroup.org',
              'address' => '238 Bir Uttam Mir Shawkat Sarak, Dhaka 1208',
              'company_logo' => 'https://jobs.textiletoday.com.bd/wp-content/uploads/2019/06/nassa-96x96.png',
              'status' => '10'
            ],
            [
              'name' => 'Bangladesh Bank',
              'short_details' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
              'website' => 'https://www.bb.org.bd/',
              'phone' => '02-55665001',
              'fax' => '+44 161 999 8888',
              'email' => 'oahr.query@bb.org.bd',
              'address' => 'Kamalapur Box Culvert Rd, Dhaka 1000',
              'company_logo' => 'https://jobs.textiletoday.com.bd/wp-content/uploads/2019/06/BB520170823191926-96x96.jpg',
              'status' => '10'
            ],
            [
              'name' => 'BKMEA',
              'short_details' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
              'website' => 'bkmea.com',
              'phone' => '02-9670498',
              'fax' => '+44 161 999 8888',
              'email' => 'bkmea-seip@bkmea.com',
              'address' => 'Planner 13/A Sonargaon Road, Banglamotor, Dhaka-1000, 13/A Sonargaon Road, Dhaka 1000',
              'company_logo' => 'https://jobs.textiletoday.com.bd/wp-content/uploads/2019/06/images-1-96x96.jpeg',
              'status' => '10'
            ],
            [
              'name' => 'Khurram Bahadur',
              'short_details' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
              'website' => 'khurrambahadur.com',
              'phone' => '02-9670498',
              'fax' => '+44 161 999 8888',
              'email' => 'khurram@textiletoday.com.bd',
              'address' => 'Planner 13/A Sonargaon Road, Banglamotor, Dhaka-1000, 13/A Sonargaon Road, Dhaka 1000',
              'company_logo' => 'https://secure.gravatar.com/avatar/1f2283a2c82c2181d0bef1dba3db7d4c?s=96&d=mm&r=g',
              'status' => '10'
            ],
            [
              'name' => 'Snowtex',
              'short_details' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
              'website' => 'snowtex.com.bd',
              'phone' => '02-9670498',
              'fax' => '+44 161 999 8888',
              'email' => 'nfo@snowtex.org',
              'address' => 'Avenue-02, Road No.-13, House No.-1322, Dhaka 1216',
              'company_logo' => 'https://jobs.textiletoday.com.bd/wp-content/uploads/2019/06/0-1-96x96.png',
              'status' => '10'
            ],
            [
              'name' => 'dbl',
              'short_details' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
              'website' => 'dbl-group.com/',
              'phone' => '02-9127574',
              'fax' => '+44 161 999 8888',
              'email' => 'info@dbl-group.com',
              'address' => 'Capita South Avenue Tower Road 3, Dhaka 1212',
              'company_logo' => 'https://jobs.textiletoday.com.bd/wp-content/uploads/2019/06/dbl-96x96.png',
              'status' => '10'
            ],
            [
              'name' => 'Artsana Group',
              'short_details' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
              'website' => 'artsana.com',
              'phone' => '02-9670498',
              'fax' => '+44 161 999 8888',
              'email' => 'Borhan.Uzzaman@artsana.com	',
              'address' => 'Planner 13/A Sonargaon Road, Banglamotor, Dhaka-1000, 13/A Sonargaon Road, Dhaka 1000',
              'company_logo' => 'https://jobs.textiletoday.com.bd/wp-content/uploads/2019/06/ok-1-96x96.png',
              'status' => '10'
            ],
            [
              'name' => 'Carter’s Global Sourcing Limited',
              'short_details' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
              'website' => 'carters.com',
              'phone' => '02-9670498',
              'fax' => '+44 161 999 8888',
              'email' => 'Recruit.Bangladesh@carters.com',
              'address' => 'Planner 13/A Sonargaon Road, Banglamotor, Dhaka-1000, 13/A Sonargaon Road, Dhaka 1000',
              'company_logo' => 'https://jobs.textiletoday.com.bd/wp-content/uploads/2019/06/asdfgh-96x96.jpg',
              'status' => '10'
            ],
            [
              'name' => 'Jamuna Group',
              'short_details' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
              'website' => 'bkmea.com',
              'phone' => '02-9670498',
              'fax' => '+44 161 999 8888',
              'email' => 'hr@jamunagroup-bd.com',
              'address' => 'Dhaka 1000',
              'company_logo' => 'https://jobs.textiletoday.com.bd/wp-content/uploads/2019/06/Jamuna_Group-96x96.png',
              'status' => '10'
            ],
            // [
            //   'name' => 'Barnali Textile & Printing Industries Pvt Ltd.',
            //   'short_details' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
            //   'website' => 'barnalitextile.com.bd/',
            //   'phone' => '02-9670498',
            //   'fax' => '+44 161 999 8888',
            //   'email' => 'jobs@barnalitextile.com.bd',
            //   'address' => 'Godenail',
            //   'company_logo' => 'https://jobs.textiletoday.com.bd/wp-content/uploads/2019/06/barnali_logo_20170419121438_1255-96x96.png',
            //   'status' => '10'
            // ],
            [
              'name' => 'Ananta Group',
              'short_details' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
              'website' => 'ananta-bd.com',
              'phone' => '02-8810617',
              'fax' => '+44 161 999 8888',
              'email' => 'careers@ananta-bd.com',
              'address' => 'House 20 Rd 99, Dhaka 1212',
              'company_logo' => 'https://jobs.textiletoday.com.bd/wp-content/uploads/2019/06/ananta-96x96.jpg',
              'status' => '10'
            ],
            [
              'name' => 'Silver Line Group',
              'short_details' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
              'website' => 'silverglobalfashion.com',
              'phone' => '02-8810617',
              'fax' => '+44 161 999 8888',
              'email' => 'job@silver.com',
              'address' => '52 Gulshan Ave, Dhaka 1212',
              'company_logo' => 'https://jobs.textiletoday.com.bd/wp-content/uploads/2019/06/JOBPORTAL-1506142031-96x96.png',
              'status' => '10'
            ],
            // [
            //   'name' => 'Kadena Sportwear Ltd',
            //   'short_details' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
            //   'website' => 'kadenasportswear.com',
            //   'phone' => '0816-2901',
            //   'fax' => '+44 161 999 8888',
            //   'email' => 'job@kadenasportwear.com',
            //   'address' => 'SFB#5, Comilla EPZ',
            //   'company_logo' => 'https://jobs.textiletoday.com.bd/wp-content/uploads/2019/06/kadena-96x96.png',
            //   'status' => '10'
            // ],
            [
              'name' => 'Shanto-Mariam Fashions Limited',
              'short_details' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
              'website' => 'shantomariamfashions.com',
              'phone' => '02-8810617',
              'fax' => '+44 161 999 8888',
              'email' => 'officecentralhr@gmail.com',
              'address' => 'Savar Union',
              'company_logo' => 'https://jobs.textiletoday.com.bd/wp-content/uploads/2019/06/shanto_mariam_fashions_limited_20170515123417_360-96x96.png',
              'status' => '10'
            ],
            [
              'name' => 'Brac Skills Development Programme',
              'short_details' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
              'website' => 'http://www.brac.net',
              'phone' => '02-8810617',
              'fax' => '+44 161 999 8888',
              'email' => 'tanvir.anam@gmail.com',
              'address' => '52 Gulshan Ave, Dhaka 1212',
              'company_logo' => 'https://jobs.textiletoday.com.bd/wp-content/uploads/2019/06/brac-96x96.png',
              'status' => '10'
            ],
            [
              'name' => 'BITOPI GROUP',
              'short_details' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
              'website' => 'http://www.bitopi-group.com',
              'phone' => '02-8810617',
              'fax' => '+44 161 999 8888',
              'email' => 'jobs@bitopibd.com',
              'address' => '822/3, Begum Rokeya Avenue, Dhaka 1216',
              'company_logo' => 'https://jobs.textiletoday.com.bd/wp-content/uploads/2019/06/JOBPORTAL-1506142031-96x96.png',
              'status' => '10'
            ],
            [
              'name' => 'BEXIMCO Holdings Ltd',
              'short_details' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
              'website' => 'beximco.com',
              'phone' => '02-8810617',
              'fax' => '+44 161 999 8888',
              'email' => 'BEXIMCO@gmail.com',
              'address' => 'Plot, Rd 35, Dhaka 1212',
              'company_logo' => 'https://jobs.textiletoday.com.bd/wp-content/uploads/2019/06/JOBPORTAL-1506142031-96x96.png',
              'status' => '10'
            ],
            [
              'name' => 'G.K. Sood',
              'short_details' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
              'website' => 'silverglobalfashion.com',
              'phone' => '02-8810617',
              'fax' => '+44 161 999 8888',
              'email' => 'universalmanagement@silver.com',
              'address' => '52 Gulshan Ave, Dhaka 1212',
              'company_logo' => 'https://jobs.textiletoday.com.bd/wp-content/uploads/2019/06/JOBPORTAL-1506142031-96x96.png',
              'status' => '10'
            ],
            [
              'name' => 'Butex',
              'short_details' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
              'website' => 'butex.com',
              'phone' => '02-9114260',
              'fax' => '+44 161 999 8888',
              'email' => 'butex@silver.com',
              'address' => '92, Shaheed Tajuddin Ahmed Avenue, Tejgaon Industrial Area, Dhaka 1208',
              'company_logo' => 'https://jobs.textiletoday.com.bd/wp-content/uploads/2019/06/BUTex_LOGO-96x96.png',
              'status' => '10'
            ],
            [
              'name' => 'ICA Global Sourcing Limited Company Location Bangladesh',
              'short_details' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
              'website' => 'ica.com',
              'phone' => '02-8810617',
              'fax' => '+44 161 999 8888',
              'email' => 'ica@gmail.com',
              'address' => 'Block J, House, # 36 Rd No 18, Dhaka 1230',
              'company_logo' => 'https://jobs.textiletoday.com.bd/wp-content/uploads/2019/05/ICA-96x96.png',
              'status' => '10'
            ],
            [
              'name' => 'BJRI',
              'short_details' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
              'website' => 'bjri.gov.com',
              'phone' => '02-9110868',
              'fax' => '+44 161 999 8888',
              'email' => 'bjri.com',
              'address' => 'Manik Mia Ave, Dhaka 1207',
              'company_logo' => 'https://jobs.textiletoday.com.bd/wp-content/uploads/2019/05/govt_logo-96x96.png',
              'status' => '10'
            ],
            [
              'name' => 'Pride Group',
              'short_details' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
              'website' => 'pride-grp.com',
              'phone' => '02-8810617',
              'fax' => '+44 161 999 8888',
              'email' => 'career@pride-grp.com',
              'address' => 'Dhaka 1212',
              'company_logo' => 'https://jobs.textiletoday.com.bd/wp-content/uploads/2019/05/dff-96x96.png',
              'status' => '10'
            ],
            [
              'name' => 'Skytex Accessories',
              'short_details' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
              'website' => 'skytexbd.com',
              'phone' => '01811-455091',
              'fax' => '+44 161 999 8888',
              'email' => 'skytexail@gmail.com',
              'address' => '234 Shahid Latif Rd, Dhaka 1230',
              'company_logo' => 'https://jobs.textiletoday.com.bd/wp-content/uploads/2019/05/logo-96x96.jpg',
              'status' => '10'
            ],
            [
              'name' => 'Reedisha Blended Yarn Limited',
              'short_details' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
              'website' => 'bhaluka.com',
              'phone' => '02-8810617',
              'fax' => '+44 161 999 8888',
              'email' => 'info@groupreedisha-bd.com',
              'address' => 'Bhaluka Upazila,Bangladesh',
              'company_logo' => 'https://jobs.textiletoday.com.bd/wp-content/uploads/2019/05/dfluj-96x96.jpg',
              'status' => '10'
            ],
            [
              'name' => 'Esquire Knit Composite Ltd.',
              'short_details' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
              'website' => 'esquireknit.com',
              'phone' => '01734-955797',
              'fax' => '+44 161 999 8888',
              'email' => 'info@esquirebd.com',
              'address' => 'Esquire Tower, 7th floor, 21 Shaheed Tajuddin Ahmed Avenue, Dhaka 1208, Bangladesh',
              'company_logo' => 'https://jobs.textiletoday.com.bd/wp-content/uploads/2019/05/Esquire-Group-Logo-96x96.png',
              'status' => '10'
            ],
            [
              'name' => 'Pakiza Knit Composite Ltd',
              'short_details' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
              'website' => 'pakizaknit.com',
              'phone' => '02-8810617',
              'fax' => '+44 161 999 8888',
              'email' => 'hrpkcl111@gmail.com',
              'address' => 'Dhaka - Aricha Hwy, Savar Union 1340',
              'company_logo' => 'https://jobs.textiletoday.com.bd/wp-content/uploads/2019/05/pakiza-96x96.jpg',
              'status' => '10'
            ],
            [
              'name' => 'United Business Line DMCC',
              'short_details' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
              'website' => 'silverglobalfashion.com',
              'phone' => '+1-855-374-1199',
              'fax' => '+44 161 999 8888',
              'email' => 'jobs.ublbd@gmail.com',
              'address' => '52 Gulshan Ave, Dhaka 1212',
              'company_logo' => 'https://jobs.textiletoday.com.bd/wp-content/uploads/2019/05/og-image-96x96.jpg',
              'status' => '10'
            ],
            [
              'name' => 'Decathlon Sports Bangladesh LTD',
              'short_details' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
              'website' => 'decathlon.com',
              'phone' => '01313-084550',
              'fax' => '+44 161 999 8888',
              'email' => 'decathlon@gmail.com',
              'address' => 'Plot 16 & 17, Road 12, Dhaka 1230',
              'company_logo' => 'https://jobs.textiletoday.com.bd/wp-content/uploads/2019/05/huge-96x96.jpg',
              'status' => '10'
            ],
            [
              'name' => 'Fariha Group',
              'short_details' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
              'website' => 'farihagroup.com',
              'phone' => '02-9331471',
              'fax' => '+44 161 999 8888',
              'email' => 'fariha.group@yahoo.com',
              'address' => 'Khadun Dhaka - Sylhet Hwy, South Rupshi',
              'company_logo' => 'https://jobs.textiletoday.com.bd/wp-content/uploads/2019/05/FARIAH-96x96.png',
              'status' => '10'
            ],
            [
              'name' => 'ELEGANT Group',
              'short_details' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
              'website' => 'elegant.com.bd',
              'phone' => '+1-855-374-1199',
              'fax' => '+44 161 999 8888',
              'email' => 'jobs@elegant-fashion.org',
              'address' => '52 Gulshan Ave, Dhaka 1212',
              'company_logo' => 'https://jobs.textiletoday.com.bd/wp-content/uploads/2019/05/15_photo_15310-96x96.jpg',
              'status' => '10'
            ],
            [
              'name' => 'Reza Group',
              'short_details' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
              'website' => 'rezagroup-bd.com',
              'phone' => '02-8900321',
              'fax' => '+44 161 999 8888',
              'email' => 'hr@rezagroup-bd.com',
              'address' => 'House 08 Rd 03, Dhaka 1229',
              'company_logo' => 'https://jobs.textiletoday.com.bd/wp-content/uploads/2019/05/reza-96x96.png',
              'status' => '10'
            ],
            [
              'name' => 'Guangdong Jianye Textile Group Co.,Ltd',
              'short_details' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
              'website' => 'silverglobalfashion.com',
              'phone' => '+1-855-374-1199',
              'fax' => '+44 161 999 8888',
              'email' => 'manager@jianyechina.com',
              'address' => '52 Gulshan Ave, Dhaka 1212',
              'company_logo' => 'https://jobs.textiletoday.com.bd/wp-content/uploads/2019/05/download-1-96x96.jpg',
              'status' => '10'
            ],
            [
              'name' => 'Jericho Imex Ltd.',
              'short_details' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
              'website' => 'jerichoimex.com',
              'phone' => '+1-855-374-1199',
              'fax' => '+44 161 999 8888',
              'email' => 'richardwong@blitzshanghai.com	#',
              'address' => 'Rd No 21, Dhaka 1212',
              'company_logo' => 'https://jobs.textiletoday.com.bd/wp-content/uploads/2019/05/jer-96x96.png',
              'status' => '10'
            ],
            [
              'name' => 'Al Islam Chemi Ltd.',
              'short_details' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
              'website' => 'alislamchemi.com',
              'phone' => '02-9862880',
              'fax' => '+44 161 999 8888',
              'email' => 'alislamchemi@gmail.com',
              'address' => 'House : 28, Road No. 14, Block : G, Dhaka 1212',
              'company_logo' => 'https://jobs.textiletoday.com.bd/wp-content/uploads/2019/05/Ali-96x96.jpg',
              'status' => '10'
            ],
            [
              'name' => 'Mother Color Limited',
              'short_details' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
              'website' => 'mothercolor.com',
              'phone' => '01683-113625',
              'fax' => '+44 161 999 8888',
              'email' => 'info@mothercolor.com',
              'address' => 'Fatullah',
              'company_logo' => 'https://jobs.textiletoday.com.bd/wp-content/uploads/2019/05/Mother-Color-Logo-96x96.png',
              'status' => '10'
            ],
            [
              'name' => 'NITER',
              'short_details' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
              'website' => 'niter.edu.com',
              'phone' => '01755-060275',
              'fax' => '+44 161 999 8888',
              'email' => 'ad.niter@gmail.com',
              'address' => 'Kohinoor gate, Dhaka - Aricha Hwy, Dhaka',
              'company_logo' => 'https://jobs.textiletoday.com.bd/wp-content/uploads/2019/05/NITER_logo_20170413105542_1106-96x96.png',
              'status' => '10'
            ],
            [
              'name' => 'Padma Wears Limited',
              'short_details' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
              'website' => 'padmawears.com',
              'phone' => '+1-855-374-1199',
              'fax' => '+44 161 999 8888',
              'email' => 'career@padmawears.com',
              'address' => 'Chittagong',
              'company_logo' => 'https://jobs.textiletoday.com.bd/wp-content/uploads/2019/05/Padma-Wears-Limited_20181011120405_5048-96x96.jpg',
              'status' => '10'
            ],
            [
              'name' => 'G.R. G.R. Corporation',
              'short_details' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
              'website' => 'wsj.com',
              'phone' => '+1-855-374-1199',
              'fax' => '+44 161 999 8888',
              'email' => 'alok@grcorportaion.co.in',
              'address' => '52 Gulshan Ave, Dhaka 1212',
              'company_logo' => 'https://jobs.textiletoday.com.bd/wp-content/uploads/2019/05/GR-96x92.jpg',
              'status' => '10'
            ],
            [
              'name' => 'Desh Group Desh Group of Companies',
              'short_details' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
              'website' => 'deshgroup.com',
              'phone' => '01711-024119',
              'fax' => '+44 161 999 8888',
              'email' => 'admin@deshgroup.com',
              'address' => 'Awal Center (6th Floor) 34, Kemal Ataturk Avenue C/A 1213, Dhaka 1213',
              'company_logo' => 'https://jobs.textiletoday.com.bd/wp-content/uploads/2019/05/desh-96x96.jpg',
              'status' => '10'
            ],
            [
              'name' => 'MAS Intimates Bangladesh (Pvt.) Ltd.',
              'short_details' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
              'website' => 'masholdings.com',
              'phone' => '03109-50990',
              'fax' => '+44 161 999 8888',
              'email' => 'MASIntimatesBD@masholdings.com',
              'address' => 'Chittagong',
              'company_logo' => 'https://jobs.textiletoday.com.bd/wp-content/uploads/2019/05/Mas_Holdings_Logo-96x96.png',
              'status' => '10'
            ],
            [
              'name' => 'JC Penney',
              'short_details' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
              'website' => 'jcpenney.com',
              'phone' => '+1-855-374-1199',
              'fax' => '+44 161 999 8888',
              'email' => 'JCPenney@yahoo.com',
              'address' => 'Plano, Texas, United States',
              'company_logo' => 'https://jobs.textiletoday.com.bd/wp-content/uploads/2019/05/JCPenney-1223-96x96.jpg',
              'status' => '10'
            ],
            [
              'name' => 'Master Accessories Pvt Ltd',
              'short_details' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
              'website' => 'masteracc.com',
              'phone' => '01701-676200',
              'fax' => '+44 161 999 8888',
              'email' => 'admin@masteracc.com',
              'address' => '52 Gulshan Ave, Dhaka 1212',
              'company_logo' => 'https://jobs.textiletoday.com.bd/wp-content/uploads/2019/05/IMG_20190521_000154_449-96x96.jpg',
              'status' => '10'
            ],
            [
              'name' => 'Huaren Linen Company Ltd.',
              'short_details' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
              'website' => 'huarenlinen.com',
              'phone' => '02-55093534',
              'fax' => '+44 161 999 8888',
              'email' => 'huaren_bd@huarenlinen.com',
              'address' => '15 Rabindra Sarani, Dhaka 1230',
              'company_logo' => 'https://jobs.textiletoday.com.bd/wp-content/uploads/2019/05/IMG_20190519_190650_501-96x96.jpg',
              'status' => '10'
            ],
            [
              'name' => 'Hamim Company Ltd.',
              'short_details' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
              'website' => 'hameemdenim.com',
              'phone' => '01714-135232',
              'fax' => '+44 161 999 8888',
              'email' => 'hamim@gmail.com	',
              'address' => '52 Gulshan Ave, Dhaka 1212',
              'company_logo' => 'https://jobs.textiletoday.com.bd/wp-content/uploads/2019/05/IMG_20190521_000154_449-96x96.jpg',
              'status' => '10'
            ],
            [
              'name' => 'Pretty Group',
              'short_details' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
              'website' => 'prettygroupbd.com',
              'phone' => '02-9852056',
              'fax' => '+44 161 999 8888',
              'email' => 'zerzina.hr@prettygroupbd.com',
              'address' => 'House # 5/A, Road # 94, Gulshan-2, Gazipur Sadar Upazila, dhaka 1212',
              'company_logo' => 'https://jobs.textiletoday.com.bd/wp-content/uploads/2019/05/prettygroupbd-96x96.jpg',
              'status' => '10'
            ],
            [
              'name' => 'Dekko Accessories Ltd.',
              'short_details' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
              'website' => 'dekkogroup.com',
              'phone' => '02-9138626',
              'fax' => '+44 161 999 8888',
              'email' => 'jobs@dekkogroup.com',
              'address' => 'House-40, Concord Royal Court, Road-16, Road-27(Old), Dhanmondi R/A, Dhaka 1209',
              'company_logo' => 'https://jobs.textiletoday.com.bd/wp-content/uploads/2019/05/dekko_accessories_logo_20170513122747_1751-96x96.png',
              'status' => '10'
            ],
            [
              'name' => 'Wing Fat Enterprise Ltd.',
              'short_details' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
              'website' => 'bloomberg.com',
              'phone' => '02-8410392',
              'fax' => '+44 161 999 8888',
              'email' => 'hr@wingfatbd.net',
              'address' => 'House 207 Lane - 2, Dhaka 1206',
              'company_logo' => 'https://jobs.textiletoday.com.bd/wp-content/uploads/2019/05/Wing-Fat-Logo-96x78.png',
              'status' => '10'
            ],
            [
              'name' => 'Frame House Footwear Ltd',
              'short_details' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
              'website' => 'ifmeab.org',
              'phone' => '01713-302889',
              'fax' => '+44 161 999 8888',
              'email' => 'hr@framehousebd.com',
              'address' => 'Dakhsin Para, Thana Bus Stand, 1350',
              'company_logo' => 'https://jobs.textiletoday.com.bd/wp-content/uploads/2019/05/frame-96x92.jpg',
              'status' => '10'
            ],
            [
              'name' => 'Amstel Fashion BD Ltd',
              'short_details' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
              'website' => 'amstelfashionbd.com',
              'phone' => '02-8822325',
              'fax' => '+44 161 999 8888',
              'email' => 'admin2@amstelfashionbd.com	',
              'address' => 'Plot #21, Road #19, Dhaka',
              'company_logo' => 'https://jobs.textiletoday.com.bd/wp-content/uploads/2019/05/Ams-96x96.jpg',
              'status' => '10'
            ],
            [
              'name' => 'M/S Padma Textile Ltd.',
              'short_details' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
              'website' => 'padmatextiles.com',
              'phone' => '0841-2292',
              'fax' => '+44 161 999 8888',
              'email' => 'padma@gmail.com',
              'address' => 'Dhaka - Mymensingh Hwy, Tongi',
              'company_logo' => 'https://jobs.textiletoday.com.bd/wp-content/uploads/2019/05/padma-textiles-96x96.jpg',
              'status' => '10'
            ],
            [
              'name' => 'ACS Textile Ltd.',
              'short_details' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
              'website' => 'acstextiles.com',
              'phone' => '09678-500445',
              'fax' => '+44 161 999 8888',
              'email' => 'hr@acstextiles.com',
              'address' => 'Tetlabo, Ward No-3',
              'company_logo' => 'https://jobs.textiletoday.com.bd/wp-content/uploads/2019/05/ACS_Logo-96x96.jpg',
              'status' => '10'
            ],
            [
              'name' => 'EDGE INTERNATIONAL',
              'short_details' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
              'website' => 'edge.ai.com',
              'phone' => '01701-676200',
              'fax' => '+44 161 999 8888',
              'email' => 'Merchandiser@edgeinternationalbd.com',
              'address' => '24 রোড # ৯ বি, Dhaka',
              'company_logo' => 'https://jobs.textiletoday.com.bd/wp-content/uploads/2019/05/edge-logo-96x96.png',
              'status' => '10'
            ],
            [
              'name' => 'Park Company Ltd.',
              'short_details' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
              'website' => 'softpark.com',
              'phone' => '01713-287123',
              'fax' => '+44 161 999 8888',
              'email' => 'recruitment.parkcorp@gmail.com	',
              'address' => 'বাড়ি#৩১, Block#D, Dhaka 1216',
              'company_logo' => 'https://jobs.textiletoday.com.bd/wp-content/uploads/2019/05/park-96x96.png',
              'status' => '10'
            ],
            [
              'name' => 'Palmal Industries',
              'short_details' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
              'website' => 'palmalgarments.com',
              'phone' => '02-9897529',
              'fax' => '+44 161 999 8888',
              'email' => 'smali.hrm@palmalgarments.com	',
              'address' => 'Dhaka 1212',
              'company_logo' => 'https://jobs.textiletoday.com.bd/wp-content/uploads/2019/05/palmal-96x96.png',
              'status' => '10'
            ],
            [
              'name' => 'Checkpoint Systems',
              'short_details' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
              'website' => 'checkpointsystems.com',
              'phone' => '01701-676200',
              'fax' => '+44 161 999 8888',
              'email' => 'checkpointsystems@gmail.com	',
              'address' => '52 Gulshan Ave, Dhaka 1212',
              'company_logo' => 'https://jobs.textiletoday.com.bd/wp-content/uploads/2019/05/IMG_20190521_000154_449-96x96.jpg',
              'status' => '10'
            ],
            [
              'name' => 'Zamira fashion',
              'short_details' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
              'website' => 'zamirafashion.com',
              'phone' => '02-8412326',
              'fax' => '+44 161 999 8888',
              'email' => 'career@zamirafashion.com',
              'address' => 'House No, 352 Lane - 5, Dhaka 1206',
              'company_logo' => 'https://jobs.textiletoday.com.bd/wp-content/uploads/2019/05/Capture-1-96x96.jpg',
              'status' => '10'
            ],
            [
              'name' => 'Avery Dennison',
              'short_details' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
              'website' => 'averydennison.com',
              'phone' => '01701-676200',
              'fax' => '+44 161 999 8888',
              'email' => 'socialmedia@averydennison.com',
              'address' => '52 Gulshan Ave, Dhaka 1212',
              'company_logo' => 'https://jobs.textiletoday.com.bd/wp-content/uploads/2019/05/avery-96x96.jpg',
              'status' => '10'
            ],
            [
              'name' => 'jobsadmin',
              'short_details' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
              'website' => 'masteracc.com',
              'phone' => '01701-676200',
              'fax' => '+44 161 999 8888',
              'email' => 'riasad1@textiletoday.com.bd',
              'address' => '52 Gulshan Ave, Dhaka 1212',
              'company_logo' => 'https://jobs.textiletoday.com.bd/wp-content/uploads/2019/05/IMG_20190521_000154_449-96x96.jpg',
              'status' => '10'
            ],
            [
              'name' => 'Epyllion Group',
              'short_details' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
              'website' => 'epylliongroup.com',
              'phone' => '02-9840223',
              'fax' => '+44 161 999 8888',
              'email' => 'info@epylliongroup.com',
              'address' => 'H.No 227/A Nina Kabbo (Level-10; Level-12; Level-13, Bir Uttam Mir Shawkat Sarak, Dhaka 1208',
              'company_logo' => 'https://jobs.textiletoday.com.bd/wp-content/uploads/2019/05/epillion-96x96.jpg',
              'status' => '10'
            ],
            [
              'name' => 'Northern Tosrifa Ltd.',
              'short_details' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
              'website' => 'ntg.com.bd',
              'phone' => '02-9817461',
              'fax' => '+44 161 999 8888',
              'email' => 'careers@ntg.com.bd',
              'address' => 'Holding No 4/2 A, Plot 49 & 57 135 Munnu Nagar,, Tongi',
              'company_logo' => 'https://jobs.textiletoday.com.bd/wp-content/uploads/2019/05/0-1-96x96.png',
              'status' => '10'
            ],
            [
              'name' => 'Anwar Group',
              'short_details' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
              'website' => 'anwargroup.com',
              'phone' => '02-9564033',
              'fax' => '+44 161 999 8888',
              'email' => 'mail@anwargroup.net',
              'address' => 'Baitul Hossain Building, 14th Floor, 27 Dilkusha, Dhaka 1000',
              'company_logo' => 'https://jobs.textiletoday.com.bd/wp-content/uploads/2019/05/anwar_big_logo-96x96.png',
              'status' => '10'
            ],
            [
              'name' => 'Windy Group',
              'short_details' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
              'website' => 'windygroupbd.net',
              'phone' => '09610-121314',
              'fax' => '+44 161 999 8888',
              'email' => 'info@windygroupbd.net',
              'address' => '13 Ranavola Rd, Dhaka 1230',
              'company_logo' => 'https://jobs.textiletoday.com.bd/wp-content/uploads/2019/05/windy-96x96.jpg',
              'status' => '10'
            ],
            [
              'name' => 'Meghna Knit Composite Ltd.',
              'short_details' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
              'website' => 'meghna.com',
              'phone' => '01734-955797',
              'fax' => '+44 161 999 8888',
              'email' => 'info@meghnaknitcomposite.com',
              'address' => 'Dhaka 1212',
              'company_logo' => 'https://jobs.textiletoday.com.bd/wp-content/uploads/2019/05/Meghna-96x96.jpg',
              'status' => '10'
            ],
            [
              'name' => 'Liz Fashion',
              'short_details' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
              'website' => 'lizfashion.com',
              'phone' => '02-8417601',
              'fax' => '+44 161 999 8888',
              'email' => 'info@lizfashion.com',
              'address' => 'House 316 Lane - 4, Dhaka 1206',
              'company_logo' => 'https://jobs.textiletoday.com.bd/wp-content/uploads/2019/05/liz-96x96.jpg',
              'status' => '10'
            ],
            [
              'name' => 'High Street Mode',
              'short_details' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
              'website' => 'street.com',
              'phone' => '09610-121314',
              'fax' => '+44 161 999 8888',
              'email' => 'info@highstreetmode.com',
              'address' => '13 Ranavola Rd, Dhaka 1230',
              'company_logo' => 'https://jobs.textiletoday.com.bd/wp-content/uploads/2019/05/high-street-mode-96x96.jpg',
              'status' => '10'
            ],
            [
              'name' => 'Vivo Mobile',
              'short_details' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
              'website' => 'gadgets.ndtv.com',
              'phone' => '09610-121314',
              'fax' => '+44 161 999 8888',
              'email' => 'admin@vivomob.com',
              'address' => '13 Ranavola Rd, Dhaka 1230',
              'company_logo' => 'https://jobs.textiletoday.com.bd/wp-content/uploads/2019/05/Capture-96x96.jpg',
              'status' => '10'
            ],
            [
              'name' => 'WMGS service Ltd.',
              'short_details' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
              'website' => 'wmgs.com',
              'phone' => '09610-121314',
              'fax' => '+44 161 999 8888',
              'email' => 'syed.khalid@wal-mart.com',
              'address' => '13 Ranavola Rd, Dhaka 1230',
              'company_logo' => 'https://jobs.textiletoday.com.bd/wp-content/uploads/2019/05/90aef91f-5441-41e2-84e2-5df6b9c8dacb-96x96.png',
              'status' => '10'
            ],
            [
              'name' => 'Checkpoint System',
              'short_details' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
              'website' => 'windygroupbd.com',
              'phone' => '09610-121314',
              'fax' => '+44 161 999 8888',
              'email' => 'info@windygroupbd.net',
              'address' => '13 Ranavola Rd, Dhaka 1230',
              'company_logo' => 'https://jobs.textiletoday.com.bd/wp-content/uploads/2019/05/windy-96x96.jpg',
              'status' => '10'
            ],
        ]);
    }
}
