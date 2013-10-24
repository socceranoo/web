<?PHP
require_once($_SERVER['DOCUMENT_ROOT']."webv2/include/fg_membersite.php");
require_once($_SERVER['DOCUMENT_ROOT']."webv2/include/db_functions.php");

$fgmembersite = new FGMembersite();

//Provide your site name here
$fgmembersite->SetWebsiteName('gatoraze.com');

//Provide the email address where you want to get notifications
$fgmembersite->SetAdminEmail('gatoraze@gmail.com');

//Provide your database login details here:
//hostname, user name, password, database name and table name
//note that the script will create the table (for example, fgusers in this case)
//by itself on submitting register.php for the first time
$fgmembersite->InitDB(/*hostname*/'localhost',
                      /*username*/'root',
                      /*password*/'Orange',
                      /*database name*/'Main',
                      /*table name*/'regusers',
                      /*user table name*/'userpair2',
                      /*transaction table name*/'money2',
                      /*resume table name*/'resume');

//For better security. Get a random string from this link: http://tinyurl.com/randstr
// and put it here
$fgmembersite->SetRandomKey('qSRcVS6DrTzrPvr');
?>
