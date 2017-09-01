<?php
    require_once 'morphyus.php';

    class firewind {
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
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
    }

/* Тестирование */


$SEARCH = new firewind();

$search_phrase = "рано";
$search_phrase = $SEARCH->make_index( $search_phrase );


$author = "Петрович";
$title = "Сталин рано пошел в школу петрович";

$author_index = $SEARCH->make_index( $author, $range = 3 );

$title_index = $SEARCH->make_index( $title, $range = 1);

$INDEX = new stdClass();
$INDEX->author = $author_index;
$INDEX->title  = $title_index;
//$INDEX = {"author" => $author_index, "title" => $title_index};
$INDEX = json_encode( $INDEX );
//var_dump( $INDEX );
echo "<br> начинаем поиск <br>";
$INDEX = json_decode( $INDEX );

$author_index = $INDEX->author;

$title_index  = $INDEX->title;

$search_author = $SEARCH->search ( $search_phrase, $author_index ); 
$search_title  = $SEARCH->search ( $search_phrase, $title_index ); 

echo "<br> search author: " . $search_author . "<br> search title: " . $search_title;






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
































