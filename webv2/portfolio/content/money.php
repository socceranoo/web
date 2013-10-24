<div class="container">
<div id="money-modal" class="modal hide fade out" style="display:none">
	<div class="modal-header">
		<a class="close" data-dismiss="modal">x</a>
		<h2 class=text-center>Money Matters</h2>
		<ul class="inline unstyled text-center">
			<li class="btn btn-inverse">HTML</li>
			<li class="btn btn-inverse">jquery</li>
			<li class="btn btn-inverse">javascript</li>
			<li class="btn btn-inverse">CSS</li>
			<li class="btn btn-inverse">photoshop</li>
			<li class="btn btn-inverse">php</li>
			<li class="btn btn-inverse">mysql</li>
		</ul>
	</div>
	<div class="modal-body">
		<h4>Motivation:</h4>
		<p>I was fed up with the online money management sites going down one after the other and it was painful switching from one solution to the other. So i started to write my own stuff which can do the trick for me and my friends since we were a small group.</p>
		<h4>Table details : (MySQL)</h4>
		<ul class=proj-ul>
			<li><p><b>Transaction table </b> - Which maintains the table to keep track of all the bills and its information (amount, who paid how much , who participated and the extent of their participation).</p></li>
			<li><p><b>User pair table </b> - A friend pair which contains the current financial standings between them.(As to who has to pay whom and how much).</p></li>
		</ul>
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
	<div class=modal-footer>
		<a class="btn btn-primary" href="http://gatoraze.com/money/" target=_blank >Visit site</a>
		<a class="btn btn-info" href="https://github.com/socceranoo/web/tree/master/webv2/money" target=_blank>View source</a>
	</div>
</div>
</div>
