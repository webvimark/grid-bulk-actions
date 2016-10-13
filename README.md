Bulk actions extension for yii 2 gridview
=====

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist webvimark/grid-bulk-actions "*"
```

or add

```
"webvimark/grid-bulk-actions": "*"
```

to the require section of your `composer.json` file.

Configuration
-------------

If input in GridView

```php

use webvimark\extensions\GridBulkActions\GridBulkActions;

<?php GridBulkActions::widget([
	'gridId'=>'user-grid',
	'actions'=>[
		Url::to(['bulk-activate', 'attribute'=>'status'])=>GridBulkActions::t('app', 'Activate'),
		Url::to(['bulk-deactivate', 'attribute'=>'status'])=>GridBulkActions::t('app', 'Deactivate'),
		'----'=>[
			Url::to(['bulk-delete'])=>GridBulkActions::t('app', 'Delete'),
		],
	],
])

?>

```

