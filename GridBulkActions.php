<?php
namespace webvimark\extensions\GridBulkActions;

use yii\base\InvalidConfigException;
use yii\base\Widget;
use yii\helpers\Url;

class GridBulkActions extends Widget
{
	/**
	 * @var array
	 */
	public $actions;

	/**
	 * @var string
	 */
	public $gridId;

	/**
	 * Default - $this->gridId . '-pjax'
	 *
	 * @var string
	 */
	public $pjaxId;

	/**
	 * @var string
	 */
	public $okButtonClass = 'btn btn-default';

	/**
	 * @var string
	 */
	public $wrapperClass = 'form-inline';

	/**
	 * @var string
	 */
	public $promptText = '--- С выбранными ---';

	/**
	 * @var string
	 */
	public $confirmationText = 'Удалить элементы ?';

	/**
	 * @throws \yii\base\InvalidConfigException
	 * @return string
	 */
	public function run()
	{
		if ( ! $this->gridId )
		{
			throw new InvalidConfigException('Missing gridId param');
		}

		$this->setDefaultOptions();

		$this->view->registerJs($this->js());

		return $this->render('index');
	}

	/**
	 * Set default options
	 */
	protected function setDefaultOptions()
	{
		if ( ! $this->actions )
		{
			$this->actions = [
				Url::to(['bulk-activate'])=>'Активировать',
				Url::to(['bulk-deactivate'])=>'Деактивировать',
				'----'=>[
					Url::to(['bulk-delete'])=>'Удалить',
				],
			];
		}

		if ( ! $this->pjaxId )
		{
			$this->pjaxId = $this->gridId . '-pjax';
		}
	}

	/**
	 * @return string
	 */
	protected function js()
	{
		$js = <<<JS

		// Select values in bulk actions list
		$(document).on('change', '[name="grid-bulk-actions"]', function () {
			var _t = $(this);
			var okButton = $(_t.data('ok-button'));

			if (_t.val()) {
				okButton.removeClass('disabled');
			}
			else {
				okButton.addClass('disabled');
			}
		});

		// Clicking OK button
		$(document).on('click', '.grid-bulk-ok-button', function () {
			var _t = $(this);
			var list = $(_t.data('list'));

			if (list.val().indexOf('bulk-delete') >= 0) {
				if ( ! confirm('$this->confirmationText') )
					return false;
			}

			$.post(list.val(), $(_t.data('grid') + ' [name="selection[]"]').serialize() )
				.done(function(){
					_t.addClass('disabled');
					list.val('');

					$.pjax.reload({container: _t.data('pjax')});
				});
		});
JS;

		return $js;

	}
} 
