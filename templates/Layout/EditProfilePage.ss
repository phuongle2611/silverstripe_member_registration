<div class="typography">
	
	<h2>$Title</h2>

	
	<% if Edit %>
		$EditProfileForm
	<% else %>
		
		<% if Saved %>
			
			<p class="savedMessage">Your profile has been saved!</p>
		<% else %>
			<p class="savedMessage">You have successfully registered!</p>
		
		<% end_if %>	
	
		
		
		<p>Your details are as follows: </p>
		<% with CurrentMember %>
			<p>
				Firstname: $FirstName<br />
				Surname: $Surname<br />
				Email: $Email<br />
				Website: <% if Website %>$Website<% else %>Unspecified<% end_if %><br />
				Job Title: <% if JobTitle %>$JobTitle<% else %>Unspecified<% end_if %><br />
				Blurb: <% if Blurb %>$Blurb<% else %>Unspecified<% end_if %>
			</p>
		<% end_with %>	
		
		<a href="$Link.?edit=1">Edit details</a>
		<br/>
		<a href="/Security/logout">Log Out</a>
	
	<% end_if %>

</div>