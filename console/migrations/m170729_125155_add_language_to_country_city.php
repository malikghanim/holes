<?php

use yii\db\Migration;

class m170729_125155_add_language_to_country_city extends Migration
{
    public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m170729_125155_add_language_to_country_city cannot be reverted.\n";

        return false;
    }

    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('{{%Languag}}', [
            'id' => $this->primaryKey(),
            'Name' => $this->char(50)->notNull(),
            'iso_639-1' => $this->char(2)->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%Languag}}');
    }
}
/*
INSERT INTO `maqtoo3`.`Languag` VALUES(1, 'English', 'en', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(2, 'Afar', 'aa', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(3, 'Abkhazian', 'ab', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(4, 'Afrikaans', 'af', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(5, 'Amharic', 'am', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(6, 'Arabic', 'ar', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(7, 'Assamese', 'as', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(8, 'Aymara', 'ay', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(9, 'Azerbaijani', 'az', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(10, 'Bashkir', 'ba', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(11, 'Belarusian', 'be', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(12, 'Bulgarian', 'bg', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(13, 'Bihari', 'bh', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(14, 'Bislama', 'bi', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(15, 'Bengali/Bangla', 'bn', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(16, 'Tibetan', 'bo', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(17, 'Breton', 'br', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(18, 'Catalan', 'ca', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(19, 'Corsican', 'co', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(20, 'Czech', 'cs', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(21, 'Welsh', 'cy', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(22, 'Danish', 'da', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(23, 'German', 'de', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(24, 'Bhutani', 'dz', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(25, 'Greek', 'el', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(26, 'Esperanto', 'eo', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(27, 'Spanish', 'es', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(28, 'Estonian', 'et', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(29, 'Basque', 'eu', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(30, 'Persian', 'fa', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(31, 'Finnish', 'fi', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(32, 'Fiji', 'fj', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(33, 'Faeroese', 'fo', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(34, 'French', 'fr', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(35, 'Frisian', 'fy', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(36, 'Irish', 'ga', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(37, 'Scots/Gaelic', 'gd', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(38, 'Galician', 'gl', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(39, 'Guarani', 'gn', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(40, 'Gujarati', 'gu', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(41, 'Hausa', 'ha', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(42, 'Hindi', 'hi', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(43, 'Croatian', 'hr', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(44, 'Hungarian', 'hu', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(45, 'Armenian', 'hy', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(46, 'Interlingua', 'ia', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(47, 'Interlingue', 'ie', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(48, 'Inupiak', 'ik', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(49, 'Indonesian', 'in', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(50, 'Icelandic', 'is', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(51, 'Italian', 'it', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(52, 'Hebrew', 'iw', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(53, 'Japanese', 'ja', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(54, 'Yiddish', 'ji', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(55, 'Javanese', 'jw', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(56, 'Georgian', 'ka', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(57, 'Kazakh', 'kk', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(58, 'Greenlandic', 'kl', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(59, 'Cambodian', 'km', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(60, 'Kannada', 'kn', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(61, 'Korean', 'ko', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(62, 'Kashmiri', 'ks', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(63, 'Kurdish', 'ku', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(64, 'Kirghiz', 'ky', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(65, 'Latin', 'la', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(66, 'Lingala', 'ln', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(67, 'Laothian', 'lo', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(68, 'Lithuanian', 'lt', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(69, 'Latvian/Lettish', 'lv', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(70, 'Malagasy', 'mg', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(71, 'Maori', 'mi', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(72, 'Macedonian', 'mk', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(73, 'Malayalam', 'ml', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(74, 'Mongolian', 'mn', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(75, 'Moldavian', 'mo', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(76, 'Marathi', 'mr', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(77, 'Malay', 'ms', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(78, 'Maltese', 'mt', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(79, 'Burmese', 'my', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(80, 'Nauru', 'na', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(81, 'Nepali', 'ne', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(82, 'Dutch', 'nl', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(83, 'Norwegian', 'no', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(84, 'Occitan', 'oc', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(85, '(Afan)/Oromoor/Oriya', 'om', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(86, 'Punjabi', 'pa', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(87, 'Polish', 'pl', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(88, 'Pashto/Pushto', 'ps', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(89, 'Portuguese', 'pt', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(90, 'Quechua', 'qu', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(91, 'Rhaeto-Romance', 'rm', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(92, 'Kirundi', 'rn', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(93, 'Romanian', 'ro', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(94, 'Russian', 'ru', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(95, 'Kinyarwanda', 'rw', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(96, 'Sanskrit', 'sa', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(97, 'Sindhi', 'sd', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(98, 'Sangro', 'sg', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(99, 'Serbo-Croatian', 'sh', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(100, 'Singhalese', 'si', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(101, 'Slovak', 'sk', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(102, 'Slovenian', 'sl', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(103, 'Samoan', 'sm', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(104, 'Shona', 'sn', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(105, 'Somali', 'so', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(106, 'Albanian', 'sq', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(107, 'Serbian', 'sr', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(108, 'Siswati', 'ss', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(109, 'Sesotho', 'st', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(110, 'Sundanese', 'su', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(111, 'Swedish', 'sv', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(112, 'Swahili', 'sw', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(113, 'Tamil', 'ta', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(114, 'Telugu', 'te', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(115, 'Tajik', 'tg', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(116, 'Thai', 'th', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(117, 'Tigrinya', 'ti', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(118, 'Turkmen', 'tk', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(119, 'Tagalog', 'tl', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(120, 'Setswana', 'tn', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(121, 'Tonga', 'to', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(122, 'Turkish', 'tr', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(123, 'Tsonga', 'ts', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(124, 'Tatar', 'tt', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(125, 'Twi', 'tw', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(126, 'Ukrainian', 'uk', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(127, 'Urdu', 'ur', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(128, 'Uzbek', 'uz', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(129, 'Vietnamese', 'vi', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(130, 'Volapuk', 'vo', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(131, 'Wolof', 'wo', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(132, 'Xhosa', 'xh', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(133, 'Yoruba', 'yo', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(134, 'Chinese', 'zh', 1501293494, 1501293494);
INSERT INTO `maqtoo3`.`Languag` VALUES(135, 'Zulu', 'zu', 1501293494, 1501293494);
*/
