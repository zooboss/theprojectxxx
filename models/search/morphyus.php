<?php
    require_once __DIR__.'/src/common.php';
    
    class morphyus {
        private $phpmorphy     = null;
        private $regexp_word   = '/([a-zа-я0-9]+)/ui';
		private $regexp_entity = '/&([a-zA-Z0-9]+);/';
    
        function __construct() {
            $directory          = __DIR__.'/dicts';
            $language           = 'ru_RU';
            $options['storage'] = PHPMORPHY_STORAGE_FILE;
            
            // Инициализация библиотеки //
            $this->phpmorphy    = new phpMorphy ($directory, $language, $options);
            
        }
        
        /**
		 * Разбивает текст на массив слов
		 *
		 * @param  {string}  content Исходный текст для выделения слов
		 * @param  {boolean} filter  Активирует фильтрацию HTML-тегов и сущностей
		 * @return {array}           Результирующий массив
		 */
        
         public function get_words ($content, $filter = true) {
             // Фильтрация ХТМЛ тэгов и сущностей //
             if ($filter) {
                 $content = strip_tags($content);
                 $content = preg_replace($this->regexp_entity, ' ', $content);
             }
             
             // Верхний регистр
             $content = mb_strtoupper ($content, 'UTF-8');
             
             //Замена ё на е
             $content = str_ireplace ('Ё', 'Е', $content);
             
             // Выделение слов из контекста //
             preg_match_all($this->regexp_word, $content, $words_src);
             return $words_src[1];
         }
        
        /**
		 * Находит леммы слова
		 * 
		 * @param {string} word   Исходное слово
		 * @param {array|boolean} Массив возможных лемм слова, либо false
		 */
        
        public function lemmatize ($word) {
            // Получение базовой формы слова //
            $lemmas = $this->phpmorphy->lemmatize($word);
            return $lemmas;
        }
        
        /**
		 * Оценивает значимость слова
		 * 
		 * @param  {string}  word    Исходное слово
		 * @param  {array}   profile Профиль текста
		 * @return {integer}         Оценка значимости от 0 до 5
		 */
        
        public function weight($word, $profile=false) {
            //Попытка определения части речи //
            $partsOfSpeech = $this->phpmorphy->getPartOfSpeech ($word);
            
            //Профиль по умолчанию
            if (!profile) {
                $profile = [
                    // Служебные части речи //
					'ПРЕДЛ' => 0,
					'СОЮЗ'  => 0,
					'МЕЖД'  => 0,
					'ВВОДН' => 0,
					'ЧАСТ'  => 0,
					'МС'    => 0,

					// Наиболее значимые части речи //
					'С'     => 5,
					'Г'     => 5,
					'П'     => 3,
					'Н'     => 3,

					// Остальные части речи //
					'DEFAULT' => 1
                ];
            }
            //Если не удалось определить возможные части речи //
            if (!$partsOfSpeech) {
                return $profile['DEFAULT'];
            }
            
            //Определение ранга //
            for ($i = 0; $i < count($partsOfSpeech); $i++) {
                if ( isset( $profile[ $partsOfSpeech[ $i ] ] ) ) {
                    $range[] = $profile[ $partsOfSpeech[ $i ] ];
                }
                else {
                    $range[] = $profile[ 'DEFAULT'];
                }
            }
        
            return max( $range );
            
        }
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
      
    }
    
    //Тестирование //
    $content = "Раз, два, три, 4, 5, вышел Петя погулять!";
    $morph = new morphyus();
    $words = $morph->get_words( $content );
    var_dump( $words );






?>