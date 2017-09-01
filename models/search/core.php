<?php
    require_once 'morphyus.php';

    class SEARCH {
        public $VERSION = "1.0";
        private $morphyus;
        
        function __construct() {
            $this->morphyus = new morphyus;
        }
        
       /**
		 * Выполняет индексирование текста
		 *
		 * @param  {string}  content Текст для индексирования
		 * @param  {integer} [range] Коэффициент значимости индексируемых данных
		 * @return {object}          Результат индексирования
		 */
        
        public function make_index ( $content, $range = 1) {
            $index = new stdClass;
            $index->range = $range;
            $index->words = [];
            
            // Выделение слов из текста //
            $words = $this->morphyus->get_words( $content );
            
            foreach( $words as $word ){
                // Оценка значимости слова //
                $weight = $this->morphyus->weight( $word );
                
                if ( $weight > 0 ) {
                    // Количество слов в индексе //
                    $length = count( $index->words );
                    
                    //Проверка существования исходного слова в индексе //
                    for ( $i = 0; $i < $length; $i++ ) {
                        if ( $index->words[ $i ]->source === $word ) {
                            
                            // Исходное слово уже есть в индексе //
                            $index->words[ $i ]->count++;
                            $index->words[ $i ]->range = $range * $index->words[ $i ]->count * $index->words[ $i ]->weight;
                            
                            continue 2;
                        }    
                    }
                
                    // Если исходного слова еще нет в индексе //
					$lemma = $this->morphyus->lemmatize( $word );
                    
                    if ( $lemma ) {
						// Проверка наличия лемм в индексе //
						for ( $i = 0; $i < $length; $i++ ) {
                            // Если у сравниваемого слова есть леммы //
							if ( $index->words[ $i ]->basic ) {
                                $difference = count(
									array_diff( $lemma, $index->words[ $i ]->basic )
								);
                                // Если сравниваемое слово имеет менее двух отличных лемм //
								if ( $difference === 0 ) {
                                    $index->words[ $i ]->count++;
									$index->words[ $i ]->range = 
										$range * $index->words[ $i ]->count * $index->words[ $i ]->weight;
                    
                                    // Обработка следующего слова //
									continue 2;
                                }
                            }
                        }
                    }
                    
                    // Если в индексе нет ни лемм, ни исходного слова, //
                    // значит пора добавить его //
					$node = new stdClass;
					$node->source = $word;
					$node->count  = 1;
					$node->range  = $range * $weight;
					$node->weight = $weight;
					$node->basic  = $lemma;

					$index->words[] = $node;
                    
                }
                
            }
            return $index;
                    
        }
        
        /**
		 * Выполняет поиск слов одного индексного объекта в другом
		 *
		 * @param  {object}  target Искомые данные
		 * @param  {object}  source Данные, в которых выполняется поиск
		 * @return {integer}        Суммарный ранг на основе найденных данных
		 */
        
        public function search ( $target, $index ) {
            $total_range = 0;
            
            // Перебор слов запроса //
            foreach ( $target->words as $target_word ) {
                // Перебор слов индекса //
                foreach ( $index->words as $index_word ) {
                    if ( $index_word->source === $target_word->source ) {
                        $total_range += $index_word->range;
                    } else if ( $index_word->basic && $target_word->basic ){
                        // Если у искомого с индексированным есть леммы //
                        $index_count = count( $index_word->basic );
                        $target_count = count( $target_word->basic );
                        
                        for ( $i = 0; $i < $target_count; $i++ ) {
                            for ( $j = 0; $j < $index_count; $j++ ){
                                if ( $index_word->basic[ $j ] === $target_word->basic[ $i ]){
                                    $total_range += $index_word->range;
                                }
                            }
                        }
                    }
                }
            }
            return $total_range;  
            
        }
        
        /**
		 * Выполняет интегральную индексацию по нескольким параметрам
		 *
		 * @param  {string}  author   Автор статьи
		 * @param  {string}  title    Название статьи
         * @param  {string}  content  Содержание статьи
		 * @param  {string}  keywords Ключевые слова
		 * @return {object}           Объект с индексами
		 */
        
        public function integrated_index ( $author, $title, $content, $keywords ) {
            $author_index   = $this->make_index( $author, $range = 5 );
            $title_index    = $this->make_index( $title, $range = 10 );
            $content_index  = $this->make_index( $content, $range = 1 );
            $keywords_index = $this->make_index( $keywords, $range = 5);
            
            $integrate_index = new stdClass();
            $integrate_index->author    = $author_index;
            $integrate_index->title     = $title_index;
            $integrate_index->content   = $content_index;
            $integrate_index->keywords  = $keywords_index;
            
            return $integrate_index;
        }
        
        /**
		 * Выполняет интегральную индексацию по нескольким параметрам
		 *
		 * @param  {string}  search_phrase_index   Индекс поисковой фразы
		 * @param  {string}  integrated_index      Общий индекс статьи
         * @return {int}                           Общий поисковый рейтинг фразы в статье
		 */
        
        public function integrated_search ( $search_phrase_index, $integrated_index ) {
            $author_index   = $integrated_index->author;
            $title_index    = $integrated_index->title;
            $content_index  = $integrated_index->content;
            $keywords_index = $integrated_index->keywords;
            
            $integrated_range =
                $this->search( $search_phrase_index, $author_index )
                + $this->search( $search_phrase_index, $title_index )
                + $this->search( $search_phrase_index, $content_index )
                + $this->search( $search_phrase_index, $keywords_index );
            
            return $integrated_range;
        }
                
        
    }

    








/* Тестирование */
// Готовый код примера поиска, вместо строк подставить значения из бд //
/*
$SEARCH = new firewind();

$search_phrase = "нахуй шла";
$search_phrase = $SEARCH->make_index( $search_phrase );

$author   = "Петрович";
$title    = "Сталин рано пошел в школу петрович";
$content  = "Шла саша сталин и всех их убило потому что левый петрович поехали в правду и приехали нахуй";
$keywords = "Сталин, нахуй";

$index = $SEARCH->integrated_index( $author, $title, $content, $keywords );
$index = json_encode( $index );
$index = json_decode( $index );

$search = $SEARCH->integrated_search( $search_phrase, $index);

echo $search;

/*


//echo "<br> search author: " . $search_author . "<br> search title: " . $search_title;






/*
$search = $SEARCH->make_index ( $search );
$search2 = $SEARCH->search( $search, $index2);
$search = $SEARCH->search( $search, $index );


var_dump( $index );
echo " ";
var_dump( $index2 );

var_dump($search);
var_dump($search2);
*/

?>
































