
/**
  I read about this here http://blog.muench-worms.de/news/de/12/phpstorm-code-completion-fuer-factories/108
*/

namespace PHPSTORM_META {
 
     $STATIC_METHOD_TYPES = [
         
         \VmModel::getModel('') => [
             'product' instanceof \VirtueMartModelProduct,
             'rating/rating' instanceof \Mage_Rating_Model_Rating,
         ],
     ];
 
 }