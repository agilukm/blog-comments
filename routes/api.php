<?php
//Route comments

$router->get('comments', 'CommentController@browse');
$router->get('comments/{id:\d+}', 'CommentController@read');
$router->get('comments/post/{id:\d+}', 'CommentController@read_by_post');
$router->patch('comments/{id:\d+}','CommentController@edit');
$router->post('comments','CommentController@add');
$router->delete('comments', 'CommentController@delete');

?>