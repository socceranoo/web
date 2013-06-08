<div class=fullcontent>
	<p>A simple online solution for money management, expense reporting tool where friends and roommates can track where their money is and how much to pay each other or how much to be paid back. All registered users have access to the tool and can add other registered users as their friends.</p>
	<div class="circleholder sevencircles">
		<div class="circle"><div class="innercircle green"><span>php</span></div></div>
		<div class="circle"><div class="innercircle violet"><span>mysql</span></div></div>
		<div class="circle"><div class="innercircle orange"><span>HTML</span></div></div>
		<div class="circle"><div class="innercircle blue"><span>jquery</span></div></div>
		<div class="circle"><div class="innercircle green"><span>javascript</span></div></div>
		<div class="circle"><div class="innercircle violet"><span>ajax</span></div></div>
		<div class="circle"><div class="innercircle red"><span>CSS</span></div></div>
	</div>
	<div class="halfcontent left">
		<h4>Motivation: </h4>
		<p>I was fed up with the online money management sites going down one after the other and it was painful switching from one solution to the other. So i started to write my own stuff which can do the trick for me and my friends since we were a small group.</p>
		<h4>Table details : (MySQL)</h4>
		<ul class=proj-ul>
			<li><p><b>Transaction table </b> - Which maintains the table to keep track of all the bills and its information (amount, who paid how much , who participated and the extent of their participation).</p></li>
			<li><p><b>User pair table </b> - A friend pair which contains the current financial standings between them.(As to who has to pay whom and how much).</p></li>
		</ul>
		<a class="big-button left" href="http://gatoraze.info/webv2/money/" target=_blank >Visit site</a>
		<a class="big-button right" href="https://github.com/socceranoo/web/tree/master/webv2/money" target=_blank>View source</a>
	</div>
	<div class="halfcontent right">
		<h4>Features : </h4>
		<ul class=proj-ul>
			<li><p><b>Add Bill</b> - This functionality allows you to add a bill with its event name, description, amount, date and user details. This can take in multiple payees, unequal payees, multiple participants (equal or unequal participation).</p></li>
			<li><p><b>Report payment </b>- You can add a payment as who was paid back.</p></li>
			<li><p><b>Edit bill </b>- Edit the existing bill and modifying its contents.</p></li>
			<li><p><b>Delete bill </b>- Delete a bill.</p></li>
			<li><p><b>Revive bill </b>- Revive a bill which was accidentally deleted.</p></li>
			<li><p><b>Add friends </b>- expand your circle by adding more people in your network.</p></li>
		</ul>

		<h4>Nice to haves (working on it ) :</h4>
		<ul class=proj-ul>
			<li><p><b>Shuffle debt option </b> - Shuffle the debt between 3 or more friends which can reduce the number of checks.</p></li>
			<li><p><b>Draw graphs </b> - using Rgraph library to display the transaction money management summaries better.</p></li>
		</ul>
	</div>

	<div class="pagediv"><p></p></div>
	<!--
	<p>Php engine at the back end which communicates with the database and tables maintained by MySQL.</p>
	Php : backend language to interact with MySQL. 
	AJAX : to implement a zero page navigation site
	JavaScript, jQuery : For managing and displaying user input. 
	HTML5 : for user input validation.
	CSS : for styling.
	-->
</div>
