<h1>Hi, you have a new contact from a user on your web site.</h1>

<h4>Message sent by {{ $input_data['name'] }}</h4>

<div>User details:</div>
<ul>
    <li><strong>Name:</strong> {{ $input_data['name'] }}</li>
    <li><strong>Email address:</strong> {{ $input_data['email'] }}</li>
    <li><strong>Message:</strong> {{ $input_data['message'] }}</li>
</ul>