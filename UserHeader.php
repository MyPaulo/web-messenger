<?php session_start();
include("connection.php");
?>

<!DOCTYPE html>
<html>

<head>
<title>Chat Messenger</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="css/style.css" />
</head>

<body data-spy="scroll" data-target=".navbar" data-offset="50">

<div class="content">
		<nav class="navbar navbar-inverse navbar-fixed-top" style="border-radius: 0px;">
		  <div class="container">
			<div class="navbar-header">
			  <a class="navbar-brand" style="color:white; font-family: serif; font-size: 20px;">Chat Messenger</a>
			</div>
			<ul class="nav navbar-nav">
			  <li><a href="AddFriends.php">Add Friends</a></li>
			  <li><a href="FriendsList.php">Friends List</a></li>
			    
			</ul>
			<ul class="nav navbar-nav navbar-right">
			  <li><a href="Logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
			</ul>
		  </div>
		</nav>
