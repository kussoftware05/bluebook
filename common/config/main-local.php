<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
			/*
            'dsn' => 'mysql:host=localhost;dbname=kusdemos_crmdb',
            'username' => 'kusdemos_crmdb',
            'password' => 'z9v-TSV$Hg!R',
            'charset' => 'utf8',
			*/
			'dsn' => 'mysql:host=127.0.0.1;dbname=bluebook',
            'username' => 'root',
            'password' => 'root',
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@admin/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
			'class' => 'yii\swiftmailer\Mailer',
			'viewPath' => '@admin/mail',
			'useFileTransport' => false,//set this property to false to send mails to real email addresses
			//comment the following array to send mail using php's mail function
			'transport' => [
				'class' => 'Swift_SmtpTransport',
            'host' => 'smtp.gmail.com',
            'username' => 'kussoftware05@gmail.com',
            'password' => 'kus12345',
            'port' => '587' ,
            'encryption' => 'tls' ,
				'streamOptions' => [
						'ssl' => [
							'verify_peer' => false,
							'verify_peer_name' => false,
						],
					],
				],
			],
    ],
];
