<?php

include "../includes/db.php";
include "../global.php";
    $to = $_POST['request_to'];
    $from = $_POST['request_from'];
    $my_friend_list = getUserInfo('friends_list',$from) . $to . ',' ;//My friends list
    $accepted_friend_list = getUserInfo('friends_list',$to) . $from . ',' ;//The new friends friend list
    $status = "friends";
    $my_total_friends = getUserInfo('friends',$from) + 1;
    $new_friend_total_friends = getUserInfo('friends',$to) + 1;
    //Update the friends_request table with friends status to notify
    $query = "UPDATE friend_requests SET request_status = '$status' WHERE request_by = '{$to}' AND request_to = '{$from}'";
    $result = mysqli_query($connection,$query);
    //Update my friends list with the new friend added
    $query = "UPDATE users SET friends_list = '$my_friend_list' , friends = '$my_total_friends' WHERE username = '$from'";
    $result = mysqli_query($connection,$query);
    //Update the friends users list with my name
    $query = "UPDATE users SET friends_list = '$accepted_friend_list' , friends = '$new_friend_total_friends' WHERE username = '$to'";
    $result = mysqli_query($connection,$query);

    if(!$result)
    {
        alert('alert-danger',"Friend request coudln't be sent!");
    }else{
        echo "<input type='submit' data-reqto='$to' data-reqfrom='$from' id='unfriend' class='btn btn-danger'
        value='Unfriend $to'>";
    }