<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use bupy7\pages\Module;
use vova07\imperavi\Widget as Imperavi;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model bupy7\pages\models\Page */
/* @var $form yii\widgets\ActiveForm */
/* @var $module bupy7\pages\Module */
/* @var $initForm bool */
/* @var $fieldsToShow array */
/* @var $contentAsText bool */

$defaultParams = [
    'initForm' => true,
    'fieldsToShow' => [
        'title',
        'display_title',
        'alias',
        'published',
        'content',
        'title_browser',
        'meta_keywords',
        'meta_description',
    ],
    'contentAsText' => false,
];

foreach ($defaultParams as $defaultParam => $defaultValue) {
    if(!isset($$defaultParam)) {
        $$defaultParam = $defaultValue;
    }
}

if($initForm)
    $form = ActiveForm::begin();


$settings = [
    'minHeight' => 200,
    'plugins' => [
        'fullscreen',
    ],
];
if ($module->imperaviLanguage) {
    $settings['lang'] = $module->imperaviLanguage;
}
if ($module->addImage || $module->uploadImage) {
    $settings['plugins'][] = 'imagemanager';
}
if ($module->addImage) {
    $settings['imageManagerJson'] = Url::to(['images-get']);
}
if ($module->uploadImage) {
    $settings['imageUpload'] = Url::to(['image-upload']);
}
if ($module->addFile || $module->uploadFile) {
    $settings['plugins'][] = 'filemanager';
}
if ($module->addFile) {
    $settings['fileManagerJson'] = Url::to(['files-get']);
}
if ($module->uploadFile) {
    $settings['fileUpload'] = Url::to(['file-upload']);
}

$contentField = $form->field($model, 'content');
if($contentAsText) {
    $contentField->textarea(['rows' => 6]);
} else {
    $contentField->widget(Imperavi::class, [
        'settings' => $settings,
    ]);
}

$fields = [
    'title' => $form->field($model, 'title')->textInput(['maxlength' => 255]),
    'display_title' => $form->field($model, 'display_title')->checkbox(),
    'alias' => $form->field($model, 'alias')->textInput(['maxlength' => 255]),
    'published' => $form->field($model, 'published')->checkbox(),
    'content' => $contentField,
    'title_browser' => $form->field($model, 'title_browser')->textInput(['maxlength' => 255]),
    'meta_keywords' => $form->field($model, 'meta_keywords')->textInput(['maxlength' => 200]),
    'meta_description' => $form->field($model, 'meta_description')->textInput(['maxlength' => 160]),
];

$fields = \yii\helpers\ArrayHelper::filter($fields, $fieldsToShow);

foreach ($fields as $field) {
    echo $field;
}
?>
<?php if($initForm): ?>
<div class="form-group">
    <?= Html::submitButton($model->isNewRecord ? Module::t('CREATE') : Module::t('UPDATE'), [
        'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary',
    ]); ?>
</div>
<?php ActiveForm::end();
endif; ?>
