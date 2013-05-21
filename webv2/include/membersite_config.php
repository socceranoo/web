<?PHP
require_once($_SERVER['DOCUMENT_ROOT']."webv2/include/fg_membersite.php");
require_once($_SERVER['DOCUMENT_ROOT']."webv2/include/db_functions.php");

$fgmembersite = new FGMembersite();

//Provide your site name here
$fgmembersite->SetWebsiteName('socceranoo.github.com');

//Provide the email address where you want to get notifications
$fgmembersite->SetAdminEmail('rasnud@gmail.com');

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
//simulate login
$uname ="socceranoo";
$password ="Am251987";
function login2(){
	global $fgmembersite, $login, $uname, $password;
	if($fgmembersite->Login2($uname, $password)) {  
		$login = true;
	}
}
function checklogin() {
	login2();
	global $fgmembersite, $login;
	if(!$fgmembersite->CheckLogin()) {
		$fgmembersite->RedirectToURL("login.php");
	}
}
//$moneytable ="money";
$moneytable ="money2";
//$deletedtable ="deleted";
$deletedtable ="deleted2";
//$pairtable ="userpair";
$pairtable ="userpair2";
$resumetable ="resume";
$songtable = "song";
$tagtable = "songtag";
$maptable = "songtagmap";
$regusertable = $fgmembersite->RegUserTable();
//$uname = $fgmembersite->UserName();
$tempresult = $fgmembersite->RunQuery("select id_user,name from $regusertable where username='$uname'");
$tempresult = mysql_fetch_array($tempresult);
$userid=$tempresult['id_user'];
$fullname = $tempresult['name'];
?>
