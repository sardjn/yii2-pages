<?php

namespace bupy7\pages;

use Yii;
use yii\base\InvalidConfigException;

/**
 * Module implements CRUD with static pages.
 *
 * @author Vasilij Belosludcev http://mihaly4.ru
 * @since 1.0.0
 */
class Module extends \yii\base\Module
{
    
    /**
     * @var string Table name of model \bupy7\pages\models\Page.
     * @see \yii\db\ActiveRecord::tableName()
     */
    public $tableName = '{{%page}}';

    /**
     * @var array The default options for TinyMCE editor.
     * @see https://github.com/2amigos/yii2-tinymce-widget/
     * @since 1.5.0
     */
    public $editorOptions = [
        'options' => ['rows' => 20],
        'clientOptions' => [
            'plugins' => [
                "advlist autolink lists link charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table contextmenu paste"
            ],
            'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
        ]
    ];
    
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->registerTranslations();
    }
    
    /**
     * Registeration translation files.
     */
    public function registerTranslations()
    {
        Yii::$app->i18n->translations['bupy7/pages/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en',
            'forceTranslation' => true,
            'basePath' => '@bupy7/pages/messages',
            'fileMap' => [
                'bupy7/pages/core' => 'core.php',
            ],
        ];
    }

    /**
     * Translates a message to the specified language.
     *
     * @param string $message the message to be translated.
     * @param array $params the parameters that will be used to replace the corresponding placeholders in the message.
     * @param string $language the language code (e.g. `en-US`, `en`). If this is null, the current application language
     * will be used.
     * @return string
     */
    public static function t($message, $params = [], $language = null)
    {
        return Yii::t('bupy7/pages/core', $message, $params, $language);
    }
}
