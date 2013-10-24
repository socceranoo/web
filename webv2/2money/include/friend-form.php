<div style="display:none" id=afdiv ng-controller="FriendCtrl">
	<form ng-submit="addFriend()">
	<legend>Add-Friends</legend>
		<label>Enter the email</label>
		<ul class=unstyled>
			<li ng-repeat="todo in friends">
				<span>{{todo.email}}</span>
			</li>
		</ul>
		<input type=email id='af-email' required ng-model="friendEmail"/>
		<input type="submit" value="Add" ng-click="addFriend()"/>
	</form>
	<form id=add-friend>
		<input type="submit" value="Submit"/>
	</form>
	<!--
	<a href="javascript:void(0);" id=temp-click>tempclick</a>
	<a href="javascript:void(0);" ng-click="empty()">X</a>
	-->
</div>
