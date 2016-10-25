<?php
/**
 * @var View $this
 * @var \webvimark\extensions\GridBulkActions\GridBulkActions $context
 */
?>
<?php
use yii\helpers\Html;
use yii\web\View;
$context = $this->context;
$gridId = uniqid($context->gridId.'-');
?>
<div class="<?= $context->wrapperClass ?>">

	<?= Html::dropDownList(
		'grid-bulk-actions',
		null,
		$context->actions,
		[
			'class'=>$context->dropDownClass,
			'id'=>"{$gridId}-bulk-actions",
			'data-ok-button'=>"#{$gridId}-ok-button",
			'prompt'=>$context->promptText,
		]
	) ?>

	<?= Html::tag('span', 'OK', [
		'class'     => "grid-bulk-ok-button {$context->okButtonClass} disabled",
		'id'        => "{$gridId}-ok-button",
		'data-list' => "#{$gridId}-bulk-actions",
		'data-pjax' => "#{$context->pjaxId}",
		'data-grid' => "#{$context->gridId}",
	]) ?>

</div>