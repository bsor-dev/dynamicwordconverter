# Dynamically convert centain words
Convert certain words to your specified words


# Create Table

CREATE TABLE `language_modify` (
  `lm_id` int(11) NOT NULL AUTO_INCREMENT,
  `l_id` int(11) NOT NULL,
  `words` text NOT NULL,
  `converted_words` text NOT NULL,
  `page_id` int(11) NOT NULL,
  PRIMARY KEY (`lm_id`)
) ENGINE=InnoDB AUTO_INCREMENT=177 DEFAULT CHARSET=latin1


# How to use
  $t = Translator::getInstance();
  
  $t->trans('News and Events', $lang);
 

