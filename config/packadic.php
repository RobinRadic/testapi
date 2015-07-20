<?php
return array(
    'acl' => array(
        'default_roles' => array(
            'Admin' => array('admin'),
            'Moderator' => array('user.create', 'user.view'),
            'User' => array('user.view')
        ),
        'default_user_roles' => array('user')
    )
);
