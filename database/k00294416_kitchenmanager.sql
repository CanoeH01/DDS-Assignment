CREATE DATABASE  IF NOT EXISTS `k00294416_kitchenmanager` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci */;
USE `k00294416_kitchenmanager`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: k00294416_kitchenmanager
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `diets`
--

DROP TABLE IF EXISTS `diets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `diets` (
  `dietID` int(11) NOT NULL AUTO_INCREMENT,
  `dietType` varchar(15) NOT NULL,
  PRIMARY KEY (`dietID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `diets`
--

LOCK TABLES `diets` WRITE;
/*!40000 ALTER TABLE `diets` DISABLE KEYS */;
INSERT INTO `diets` VALUES (1,'Vegan'),(2,'Vegetarian'),(3,'Gluten-Free'),(4,'Keto'),(5,'Dairy-Free');
/*!40000 ALTER TABLE `diets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ingredients`
--

DROP TABLE IF EXISTS `ingredients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ingredients` (
  `ingredientID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`ingredientID`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=1340 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ingredients`
--

LOCK TABLES `ingredients` WRITE;
/*!40000 ALTER TABLE `ingredients` DISABLE KEYS */;
INSERT INTO `ingredients` VALUES (1274,'Acai Berries'),(208,'Active Dry Yeast'),(210,'Agar Agar'),(133,'Aioli'),(181,'All-purpose Flour'),(154,'Allspice'),(1158,'Almond'),(212,'Almond Extract'),(224,'Almond Flakes'),(186,'Almond Flour'),(4,'Almond Milk'),(35,'Almonds'),(125,'Amaranth'),(1184,'Anise'),(39,'Apple'),(205,'Arrowroot Powder'),(109,'Artichoke'),(1145,'Arugula'),(1139,'Asparagus'),(15,'Avocado'),(1061,'Bacon'),(1058,'Bagel'),(1239,'Baguette'),(62,'Baking Powder'),(202,'Baking Soda'),(38,'Banana'),(122,'Barley'),(50,'Basil'),(178,'Bay Leaf'),(1260,'Beechnuts'),(21,'Beef'),(96,'Beetroot'),(1037,'Bell Pepper'),(53,'Black Beans'),(1051,'Black Pepper'),(1262,'Blackberries'),(1269,'Blood Orange'),(1177,'Blue Cheese'),(37,'Blueberries'),(111,'Bok Choy'),(1162,'Brazil Nut'),(1253,'Brazil Nuts'),(182,'Bread Flour'),(1059,'Bread Roll'),(1055,'Breadcrumbs'),(1278,'Breadfruit'),(1178,'Brie'),(1242,'Brioche'),(8,'Broccoli'),(1188,'Brown Rice'),(63,'Brown Sugar'),(78,'Brussels Sprouts'),(121,'Buckwheat'),(1186,'Bulgur'),(22,'Butter'),(1175,'Buttermilk'),(1140,'Butternut Squash'),(41,'Cabbage'),(184,'Cake Flour'),(1179,'Camembert'),(1258,'Candlenuts'),(199,'Cane Sugar'),(34,'Canola Oil'),(1148,'Cantaloupe'),(1275,'Carambola'),(165,'Caraway'),(155,'Cardamom'),(30,'Carrot'),(1160,'Cashew'),(36,'Cashews'),(193,'Caster Sugar'),(77,'Cauliflower'),(160,'Cayenne Pepper'),(1292,'Celeriac'),(59,'Celery'),(1243,'Challah'),(1141,'Chard'),(9,'Cheddar Cheese'),(1046,'Cherries'),(1256,'Chestnuts'),(1167,'Chia Seed'),(102,'Chia Seeds'),(6,'Chicken Breast'),(31,'Chickpeas'),(66,'Chili Powder'),(132,'Chimichurri'),(171,'Chives'),(220,'Chocolate Chips'),(1240,'Ciabatta'),(179,'Cilantro'),(151,'Cinnamon'),(1203,'Clams'),(146,'Clementine'),(231,'Clotted Cream'),(153,'Clove'),(215,'Cocoa Powder'),(1047,'Coconut'),(187,'Coconut Flour'),(18,'Coconut Milk'),(70,'Coconut Oil'),(1286,'Collard Greens'),(1174,'Condensed Milk'),(198,'Confectioners\' Sugar'),(86,'Coriander'),(54,'Corn'),(1246,'Cornbread'),(1054,'Cornmeal'),(204,'Cornstarch'),(104,'Cottage Cheese'),(1053,'Couscous'),(1200,'Crab Meat'),(75,'Cranberries'),(141,'Cranberry'),(1048,'Cream'),(1172,'Cream Cheese'),(203,'Cream of Tartar'),(232,'Crème Fraîche'),(1245,'Crumble Top Bread'),(40,'Cucumber'),(157,'Cumin'),(1151,'Currants'),(85,'Curry Powder'),(1295,'Daikon Radish'),(218,'Dark Chocolate'),(148,'Date'),(1152,'Dates'),(195,'Demerara Sugar'),(175,'Dill'),(230,'Double Cream'),(143,'Dragon Fruit'),(1198,'Duck'),(1268,'Durian'),(1193,'Egg Noodles'),(42,'Eggplant'),(3,'Eggs'),(1146,'Endive'),(1244,'English Muffin'),(1173,'Evaporated Milk'),(48,'Farfalle'),(1187,'Farro'),(163,'Fennel Seeds'),(162,'Fenugreek'),(106,'Feta'),(1049,'Feta Cheese'),(233,'Fettuccine'),(138,'Fig'),(1248,'Flatbread'),(1168,'Flaxseed'),(103,'Flaxseeds'),(1,'Flour'),(1241,'Focaccia'),(123,'Freekeh'),(46,'Fusilli'),(43,'Garlic'),(1180,'Garlic Powder'),(209,'Gelatin'),(1036,'Ginger'),(1259,'Gingko Nuts'),(223,'Glace Cherries'),(190,'Gluten-Free Flour Bl'),(119,'Gnocchi'),(1050,'Goat Cheese'),(101,'Goji Berries'),(222,'Golden Syrup'),(1150,'Gooseberries'),(142,'Gooseberry'),(1176,'Gouda'),(1044,'Grapes'),(108,'Green Beans'),(57,'Green Bell Pepper'),(1135,'Green Cabbage'),(76,'Green Peas'),(225,'Ground Almonds'),(51,'Ground Beef'),(65,'Ground Cumin'),(87,'Ground Ginger'),(144,'Guava'),(82,'Ham'),(118,'Harissa'),(1157,'Hazelnut'),(1252,'Hazelnuts'),(227,'Heavy Cream'),(1170,'Hemp Seed'),(10,'Honey'),(1263,'Honeydew'),(117,'Hummus'),(194,'Icing Sugar'),(207,'Instant Yeast'),(1267,'Jackfruit'),(1293,'Jicama'),(1034,'Kale'),(84,'Ketchup'),(1063,'Kidney Beans'),(136,'Kiwi'),(1294,'Kohlrabi'),(1261,'Kola Nuts'),(130,'Kombucha'),(1196,'Lamb'),(236,'Lasagna Sheets'),(1249,'Lavash'),(79,'Leek'),(1288,'Leeks'),(1040,'Lemon'),(213,'Lemon Extract'),(177,'Lemongrass'),(12,'Lentils'),(1035,'Lettuce'),(55,'Lime'),(1201,'Lobster'),(1265,'Longan'),(180,'Lovage'),(145,'Lychee'),(1164,'Macadamia Nut'),(1254,'Macadamia Nuts'),(47,'Macaroni'),(1270,'Mandarin'),(1042,'Mango'),(64,'Maple Syrup'),(173,'Marjoram'),(226,'Marzipan'),(83,'Mayonnaise'),(2,'Milk'),(217,'Milk Chocolate'),(124,'Millet'),(176,'Mint'),(115,'Miso Paste'),(49,'Mozzarella'),(1156,'Mulberries'),(1238,'Multigrain Bread'),(196,'Muscovado Sugar'),(80,'Mushroom'),(1202,'Mussels'),(68,'Mustard'),(1284,'Mustard Greens'),(164,'Mustard Seeds'),(1056,'Naan'),(1155,'Nectarine'),(113,'Nori'),(152,'Nutmeg'),(14,'Oats'),(110,'Okra'),(33,'Olive Oil'),(1181,'Onion Powder'),(1039,'Orange'),(214,'Orange Zest'),(167,'Oregano'),(235,'Orzo'),(1250,'Panettone'),(140,'Papaya'),(239,'Pappardelle'),(67,'Paprika'),(107,'Parmesan'),(60,'Parsley'),(1142,'Parsnip'),(139,'Passion Fruit'),(1052,'Pasta'),(188,'Pastry Flour'),(98,'Peach'),(32,'Peanut Butter'),(97,'Pear'),(1038,'Peas'),(1163,'Pecan'),(1255,'Pecans'),(45,'Penne'),(149,'Persimmon'),(134,'Pesto'),(73,'Pine Nuts'),(1041,'Pineapple'),(1161,'Pistachio'),(1251,'Pistachios'),(1057,'Pita Bread'),(128,'Plant-Based Sausage'),(1279,'Plantain'),(1045,'Plum'),(120,'Polenta'),(137,'Pomegranate'),(1171,'Poppy Seed'),(1197,'Pork Chop'),(197,'Powdered Sugar'),(1247,'Pretzel'),(1266,'Prune'),(1153,'Prunes'),(1166,'Pumpkin Seed'),(1276,'Quince'),(11,'Quinoa'),(1283,'Radicchio'),(1143,'Radish'),(74,'Raisins'),(1264,'Rambutan'),(100,'Raspberries'),(1136,'Red Cabbage'),(58,'Red Onion'),(1154,'Rhubarb'),(7,'Rice'),(1192,'Rice Noodles'),(105,'Ricotta'),(234,'Rigatoni'),(1282,'Romaine Lettuce'),(169,'Rosemary'),(1236,'Rye Bread'),(1191,'Rye Flour'),(1183,'Saffron'),(174,'Sage'),(19,'Salmon'),(135,'Salsa'),(221,'Salt'),(200,'Sanding Sugar'),(1062,'Sausage'),(1185,'Savory'),(1138,'Scallion'),(1290,'Scallions'),(1204,'Scallops'),(112,'Seaweed'),(24,'Seitan'),(185,'Self-Raising Flour'),(1190,'Semolina'),(1169,'Sesame Seed'),(1137,'Shallot'),(1289,'Shallots'),(1273,'Shredded Coconut'),(20,'Shrimp'),(229,'Single Cream'),(1195,'Soba Noodles'),(52,'Sour Cream'),(1237,'Sourdough'),(1277,'Soursop'),(69,'Soy Sauce'),(44,'Spaghetti'),(189,'Spelt Flour'),(29,'Spinach'),(1291,'Spring Onions'),(1281,'Squash'),(150,'Star Fruit'),(1149,'Starfruit'),(99,'Strawberries'),(161,'Sumac'),(1280,'Sun-dried Tomato'),(71,'Sunflower Oil'),(1165,'Sunflower Seed'),(27,'Sweet Potato'),(1285,'Swiss Chard'),(238,'Tagliatelle'),(116,'Tahini'),(114,'Tamarind'),(1271,'Tangelo'),(147,'Tangerine'),(172,'Tarragon'),(16,'Tempeh'),(126,'Tempeh Bacon'),(61,'Thyme'),(1257,'Tiger Nuts'),(5,'Tofu'),(23,'Tofu Sausage'),(28,'Tomato'),(237,'Tortellini'),(56,'Tortilla'),(1060,'Tuna'),(81,'Turkey Breast'),(158,'Turmeric'),(1144,'Turnip'),(1287,'Turnip Greens'),(131,'Tzatziki'),(1194,'Udon Noodles'),(1272,'Ugli Fruit'),(216,'Unsweetened Chocolat'),(211,'Vanilla Extract'),(127,'Vegan Cheese'),(1199,'Venison'),(1159,'Walnut'),(72,'Walnuts'),(1147,'Watercress'),(1043,'Watermelon'),(228,'Whipping Cream'),(1064,'White Beans'),(1235,'White Bread'),(219,'White Chocolate'),(1182,'White Pepper'),(26,'White Rice'),(191,'White Sugar'),(25,'Whole Wheat Bread'),(183,'Whole Wheat Flour'),(1189,'Wild Rice'),(206,'Yeast'),(13,'Yogurt'),(129,'Zoodles'),(17,'Zucchini');
/*!40000 ALTER TABLE `ingredients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recipe_diets`
--

DROP TABLE IF EXISTS `recipe_diets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recipe_diets` (
  `recipeID` int(11) NOT NULL,
  `dietID` int(11) NOT NULL,
  PRIMARY KEY (`recipeID`,`dietID`),
  KEY `fk_recipe_diets_dietID_idx` (`dietID`),
  CONSTRAINT `fk_recipe_diets_dietID` FOREIGN KEY (`dietID`) REFERENCES `diets` (`dietID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_recipe_diets_recipeID` FOREIGN KEY (`recipeID`) REFERENCES `recipes` (`recipeID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recipe_diets`
--

LOCK TABLES `recipe_diets` WRITE;
/*!40000 ALTER TABLE `recipe_diets` DISABLE KEYS */;
INSERT INTO `recipe_diets` VALUES (63,2),(67,2),(68,2),(80,1),(80,2),(80,3),(80,5),(92,2),(107,3),(107,4),(108,1),(108,2),(108,4),(108,5);
/*!40000 ALTER TABLE `recipe_diets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recipe_ingredients`
--

DROP TABLE IF EXISTS `recipe_ingredients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recipe_ingredients` (
  `recipeIngredientID` int(11) NOT NULL AUTO_INCREMENT,
  `ingredientID` int(11) NOT NULL,
  `recipeID` int(11) NOT NULL,
  `quantity` decimal(10,0) NOT NULL,
  `unit` enum('g','kg','oz','lb','l','ml','tsp','tbsp','cups','') NOT NULL,
  `essential` tinyint(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`recipeIngredientID`),
  KEY `fk_ingredients_has_recipes_recipes1_idx` (`recipeID`),
  KEY `fk_ingredients_has_recipes_ingredients1_idx` (`ingredientID`),
  CONSTRAINT `fk_ingredients_has_recipes_ingredients1` FOREIGN KEY (`ingredientID`) REFERENCES `ingredients` (`ingredientID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ingredients_has_recipes_recipes1` FOREIGN KEY (`recipeID`) REFERENCES `recipes` (`recipeID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=202 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recipe_ingredients`
--

LOCK TABLES `recipe_ingredients` WRITE;
/*!40000 ALTER TABLE `recipe_ingredients` DISABLE KEYS */;
INSERT INTO `recipe_ingredients` VALUES (43,38,63,500,'g',1),(44,1,63,500,'g',1),(45,10,63,100,'g',0),(46,3,63,100,'g',0),(67,22,67,150,'g',1),(68,63,67,80,'g',1),(69,191,67,80,'g',1),(70,211,67,2,'tsp',1),(71,3,67,1,'g',1),(72,1,67,225,'g',1),(73,202,67,1,'tsp',1),(74,220,67,200,'g',1),(75,221,67,1,'g',1),(76,222,67,15,'g',1),(77,22,68,150,'g',1),(78,3,68,2,'g',1),(79,193,68,150,'g',1),(80,185,68,150,'g',1),(81,225,68,150,'g',1),(82,224,68,25,'g',1),(83,212,68,1,'tsp',1),(84,223,68,150,'g',1),(85,226,68,150,'g',1),(92,7,80,150,'g',1),(93,8,80,300,'g',1),(115,21,31,500,'g',1),(116,28,31,100,'g',0),(117,9,31,50,'g',0),(118,58,31,50,'g',0),(119,25,31,400,'g',0),(121,25,92,40,'g',1),(122,22,92,5,'g',1),(142,6,107,2,'',1),(143,134,107,8,'tsp',1),(144,49,107,300,'g',1),(145,221,107,3,'tbsp',1),(146,1051,107,1,'tbsp',1),(161,238,109,200,'g',1),(162,22,109,1,'tsp',1),(163,33,109,2,'tbsp',1),(164,43,109,2,'',1),(165,80,109,250,'g',1),(166,230,109,100,'ml',1),(167,107,109,30,'g',1),(168,221,109,3,'tbsp',1),(169,1051,109,2,'tbsp',1),(170,60,109,2,'tbsp',1),(171,22,64,15,'g',1),(172,44,64,100,'g',1),(173,107,64,20,'g',1),(174,52,64,50,'ml',1),(180,22,70,1,'tbsp',1),(181,43,70,1,'tsp',1),(182,1,70,3,'tbsp',1),(183,2,70,500,'ml',1),(184,9,70,250,'g',1),(185,107,70,50,'g',1),(188,33,108,1,'tbsp',1),(189,58,108,1,'',1),(190,43,108,2,'',1),(191,1036,108,1,'tbsp',1),(192,85,108,1,'tbsp',1),(193,157,108,1,'tbsp',1),(194,158,108,1,'tbsp',1),(195,28,108,400,'g',1),(196,31,108,400,'g',1),(197,18,108,200,'ml',1),(198,29,108,150,'g',1),(199,221,108,3,'tbsp',1),(200,1051,108,2,'tbsp',1),(201,7,108,300,'g',1);
/*!40000 ALTER TABLE `recipe_ingredients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recipe_reviews`
--

DROP TABLE IF EXISTS `recipe_reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recipe_reviews` (
  `recipeID` int(11) NOT NULL,
  `reviewerID` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `timeCreated` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`recipeID`,`reviewerID`),
  KEY `fk_recipe_reviews_users1_idx` (`reviewerID`),
  KEY `fk_recipe_reviews_recipes1_idx` (`recipeID`),
  CONSTRAINT `fk_recipe_reviews_recipes1` FOREIGN KEY (`recipeID`) REFERENCES `recipes` (`recipeID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_recipe_reviews_users1` FOREIGN KEY (`reviewerID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recipe_reviews`
--

LOCK TABLES `recipe_reviews` WRITE;
/*!40000 ALTER TABLE `recipe_reviews` DISABLE KEYS */;
INSERT INTO `recipe_reviews` VALUES (31,23,4,'Dont listen to the hate... these burgers are great! i love having an entire loaf of whole wheat bread as burger buns','2025-04-03 15:00:40'),(31,25,1,'I swapped the beef with lamb and this came out terrible!!!! would not reccomend!!!!','2025-04-02 09:12:44'),(63,1,4,'Great treat for the whole family in winter time :)','2025-04-02 10:27:35'),(63,10,1,'Really bad, I followed the recipe exactly. I checked after 30 mins, looked good, then it sunk. Super dense / wet horrible. Really wanted this to work reading all the great comments :(\r\n\r\n','2025-04-02 20:48:38'),(63,21,5,'One of the best banana breads I have ever eaten! would reccomend it highly','2025-04-03 14:29:23'),(64,1,5,'best pasta i have ever had!','2025-04-02 10:20:09'),(64,23,4,'Really tasty, and simple to make too','2025-04-03 15:27:41'),(67,23,3,'Tasty cookies, I will make again\r\n','2025-04-03 15:29:23'),(68,23,5,'Great cake! super flavourful without relying on too much icing','2025-04-03 15:07:47'),(70,23,3,'Im not sure about best ever, but this macaroni and cheese really hit the spot','2025-04-03 15:29:55'),(80,23,1,'This recipe is absurd..  no SALT????','2025-04-03 14:50:37'),(92,21,1,'This is not gourmet.. this is a joke. the moderators of this website need to do their job and take this down. I would give it 0 stars if i could','2025-04-03 14:31:00'),(92,25,5,'Switched the bread out for mincemeat....... still cleaning out my toaster\r\n','2025-04-03 15:43:13'),(107,10,5,'I make this recipe every week! its simple to make but really delicous with chips!!!!!!','2025-04-03 16:41:04'),(108,10,4,'Tastes just like my mum used to make! would highly recommend this recipe','2025-04-03 16:40:13'),(109,1,4,'Super tasty, makes me feel like im in the woods or something','2025-04-03 16:38:39');
/*!40000 ALTER TABLE `recipe_reviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recipe_steps`
--

DROP TABLE IF EXISTS `recipe_steps`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recipe_steps` (
  `recipeStepID` int(11) NOT NULL AUTO_INCREMENT,
  `recipeID` int(11) NOT NULL,
  `stepNo` int(11) NOT NULL,
  `instructions` varchar(255) NOT NULL,
  PRIMARY KEY (`recipeStepID`),
  KEY `fk_recipe_steps_recipes1` (`recipeID`),
  CONSTRAINT `fk_recipe_steps_recipes1` FOREIGN KEY (`recipeID`) REFERENCES `recipes` (`recipeID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=208 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recipe_steps`
--

LOCK TABLES `recipe_steps` WRITE;
/*!40000 ALTER TABLE `recipe_steps` DISABLE KEYS */;
INSERT INTO `recipe_steps` VALUES (31,63,1,'Preheat oven to 180 degrees c'),(32,63,2,'Mix all ingredients in a bowl, stirring until combined'),(33,63,3,'Add to a parchment-lined cake tin and put on middle shelf of oven for 45 minutes or until a cake-tester comes out clean'),(34,63,4,'Let cool completely (at least 2 hours) then serve and enjoy!'),(48,67,1,'Heat the oven to 190C/fan170C/gas 5 and line two baking sheets with non-stick baking paper.'),(49,67,2,'Put 150g softened salted butter, 80g light brown muscovado sugar and 80g granulated sugar into a bowl'),(50,67,3,'Beat in 2 tsp vanilla extract and 1 large egg.'),(51,67,4,'Sift 225g plain flour, ½ tsp bicarbonate of soda and ¼ tsp salt into the bowl and mix it in with a whisk until well combined'),(52,67,5,'Add 200g plain chocolate chips or chunks and stir well.'),(53,67,6,'Use a teaspoon to make small scoops of the mixture, spacing them well apart on the baking trays to prevent sticking'),(54,67,7,'Bake for 8–10 mins until they are light brown on the edges and still slightly soft in the centre'),(55,67,8,'Leave on the tray for a couple of mins to set and then lift onto a cooling rack.'),(56,68,1,'Pre-heat the oven to 180°C/160°C fan'),(57,68,2,'Butter and line a deep 18cm cake tin'),(58,68,3,'Beat the butter (150g) and caster sugar (150g) until light and fluffy'),(59,68,4,'Add the eggs one at a time, and beat well after after adding the first egg before adding the second.'),(60,68,5,'Add the almond extract (1 tsp)'),(61,68,6,'Fold in the self-raising flour (150g) and ground almonds (150g)'),(62,68,7,'Prepare the cherries by cutting half (75g) in half, keeping the other half (75g) whole'),(63,68,8,'In a seperate bowl, sprinkle a little flour over the cherries and mix to lightly coat the cherries.'),(64,68,9,'Fold the cherries into the cake mixture'),(65,68,10,'Roll out the marzipan (150g) into a circle roughly the same size as the tin – sprinkle a little icing sugat around the tin, then add the parchment'),(66,68,11,'Spoon half the mixture into the prepared tin and even out the top'),(67,68,12,'Lay the marzipan on top of the mixture in the cake tin then add the other half of the mixture and evenly disperse'),(68,68,13,'Scatter over the flaked almond (25g)'),(69,68,14,'Bake for approximately 50 minutes – You can use a skewer to check if it’s done.'),(70,68,15,'Once baked, remove from the oven and leave to cool in the tin for about 20 minutes, remove from the tin and enjoy!'),(73,80,1,'Rinse the rice under cold water until the water runs clear.'),(74,80,2,'Add rice to a pot with water (use a 2:1 ratio of water to rice).'),(75,80,3,'Bring to a boil, then reduce heat to low and cover with a lid.'),(76,80,4,'Simmer the rice for 15–20 minutes, or until all the water is absorbed.'),(77,80,5,'Remove the pot from heat and let it sit, covered, for 5 minutes.'),(78,80,6,'Meanwhile, prepare the broccoli by cutting it into bite-sized florets.'),(79,80,7,'Bring a small pot of water to boil (or set up a steamer).'),(80,80,8,'Steam or boil the broccoli for 4–5 minutes, until bright green and tender.'),(81,80,9,'Drain the broccoli if boiled.'),(82,80,10,'Fluff the rice with a fork and serve with the broccoli on the side or mixed together.'),(111,31,1,'In a large bowl, combine the ground beef, mix loosley with your hands or a spoon.'),(112,31,2,'Divide the mixture into 4 equal parts and shape them into round, flat patties. Make a small indent in the center to ensure even cooking'),(113,31,3,'Preheat a frying pan or grill over medium-high heat. Add a little oil or butter.'),(114,31,4,'Place the patties in the pan. Cook for 3–5 minutes on each side, or until well-browned and fully cooked through'),(115,31,5,'Cut the burger buns in half and lightly toast them face-down on the pan or grill until golden.'),(116,31,6,'Place lettuce on the bottom bun, followed by the cooked patty, tomato slices, ketchup/mustard, cheese, and onion'),(117,31,7,'Serve immediately with fries, salad, or your side of choice'),(119,92,1,'Put bread in the toaster until desired toast colour'),(120,92,2,'Remove bread from the toaster and slather with desired amount of butter'),(121,92,3,'Enjoy'),(159,107,1,'Preheat oven to 200c'),(160,107,2,'Cut mozzerella into slices, and grab two teaspoons for the pesto'),(161,107,3,'Butterfly the chicken breast, taking care not to split it in two'),(162,107,4,'Add butterflied breasts to an oven safe tray'),(163,107,5,'spread 2 tsps of pesto on the middle layer, and top with 1-2 slices of mozzerella'),(164,107,6,'spread 2 more tsps of pesto on the toplayer, then add with 1-2 more slices of mozzerella'),(165,107,7,'transfer tray to the oven for 30 minutes, or until the cheese is browned'),(166,107,8,'let cool for 3-5 minutes, then serve with your favourite side'),(174,109,1,'Cook pasta in salted boiling water according to package instructions. Drain and set aside.'),(175,109,2,'In a large pan, heat butter and olive oil over medium heat.'),(176,109,3,'Add garlic and sauté for 30 seconds.'),(177,109,4,'Add mushrooms and cook for 7–10 minutes until golden and tender.'),(178,109,5,'Pour in cream and reduce heat. Simmer gently for 5 minutes.'),(179,109,6,'Stir in Parmesan, then add cooked pasta to the pan and toss to coat.'),(180,109,7,'Season with salt and pepper. Serve topped with chopped parsley.'),(181,109,8,'Season with salt and pepper. Serve topped with chopped parsley.'),(182,64,1,'Put a pot of water over high heat and boil'),(183,64,2,'Add salt to the boiling water'),(184,64,3,'Add pasta to boiling water'),(185,64,4,'Cook per pasta instructions'),(186,64,5,'Once done, drain the pasta but leave a tiny bit of water'),(187,64,6,'Add the cream and butter'),(188,64,7,'Grate the parmesan over the pasta'),(189,64,8,'Mix and cook until its at a constiency you want'),(190,64,9,'Enjoy!'),(194,70,1,'Heat oven to 200C/fan 180C/gas 6. '),(195,70,2,'Boil the pasta for 2 mins less than stated on the pack. Meanwhile, melt the butter in a saucepan. '),(201,108,1,'Heat olive oil in a large pan over medium heat.'),(202,108,2,'Add onion and cook until softened, about 5 minutes.'),(203,108,3,'Stir in garlic and ginger, cook for another minute.'),(204,108,4,'Add curry powder, cumin, and turmeric. Cook for 1 minute to release aromas.'),(205,108,5,'Pour in canned tomatoes and chickpeas. Simmer for 10 minutes.'),(206,108,6,'Stir in coconut milk and spinach. Cook until spinach wilts.'),(207,108,7,'Season with salt and pepper. Serve over cooked rice.');
/*!40000 ALTER TABLE `recipe_steps` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recipes`
--

DROP TABLE IF EXISTS `recipes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recipes` (
  `recipeID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `prepTimeMinutes` int(11) NOT NULL,
  `cookTimeMinutes` int(11) NOT NULL,
  `difficulty` enum('Very Easy','Easy','Medium','Hard','Very Hard') NOT NULL DEFAULT 'Medium',
  `mealType` enum('Breakfast','Lunch','Dinner','Dessert','Snack') DEFAULT NULL,
  `creatorID` int(11) NOT NULL,
  `timeCreated` timestamp NOT NULL DEFAULT current_timestamp(),
  `thumbnail` varchar(255) DEFAULT NULL,
  `servings` int(11) NOT NULL,
  PRIMARY KEY (`recipeID`),
  KEY `fk_user_recipes_idx` (`creatorID`),
  CONSTRAINT `fk_user_recipes` FOREIGN KEY (`creatorID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=112 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recipes`
--

LOCK TABLES `recipes` WRITE;
/*!40000 ALTER TABLE `recipes` DISABLE KEYS */;
INSERT INTO `recipes` VALUES (31,'Best Ever Hamburgers','The most amazingest, greatest, bestestest burger you have ever laid eyes on',10,20,'Medium','Dinner',1,'2025-03-23 15:59:05','recipe_67e02fc8e4577.jpg',2),(63,'Banana Bread','Simple, sweet, and delicous banana bread!',15,45,'Easy','Dessert',21,'2025-03-30 14:30:04','recipe_67e9556cbea19.jpg',8),(64,'Best Alfredo','A classic for the ages, there whenever you need it',1,15,'Very Easy','Dinner',10,'2025-03-30 15:58:18','recipe_67e96a1ad66a4.jpg',1),(67,'Best Chocolate Chip Cookies','A simple chocolate chip cookie recipe for soft biscuits with a squidgy middle that will impress family and friends!',15,10,'Easy','Dessert',1,'2025-03-30 20:51:18','recipe_67e9aec6a4fa3.jpg',12),(68,'Marzipan and Cherry Cake','Delicious almond sponge with cherries and a layer of gooey marzipan in the centre.',20,50,'Easy','Dessert',1,'2025-03-30 20:59:32','recipe_67e9b0b4cb34a.jpg',8),(70,'Best ever macaroni cheese','This perfect macaroni cheese recipe comes with a creamy cheese sauce',10,40,'Medium','Dinner',10,'2025-03-30 21:12:17','recipe_67e9b3b144982.jpg',4),(80,'Broccoli with Rice','Simple but nutritious steamed broccoli with rice!',10,15,'Easy','Lunch',24,'2025-04-01 09:51:58','recipe_67ebb73edffa2.jpg',2),(92,'Gourmet Toast','Toast is perfect for a quick snack or for serving at a party. Can be made gluten free by using gluten free bread or vegan/dairy-free by using vegetable spread!',3,3,'Very Easy','Snack',1,'2025-04-01 19:16:20','recipe_67ec3b844b965.jpg',1),(107,'Pesto Chicken','Chicken breast stuffed with mozzerella, pesto, and love :) with ZERO carbs',15,30,'Medium','Dinner',25,'2025-04-03 16:12:26','recipe_67eeb36a0415f.jpg',2),(108,'Chickpea & Spinach Curry','A quick and nutritious vegetarian curry made with canned chickpeas, fresh spinach, and aromatic spices. Perfect for a weeknight dinner.',10,25,'Medium','Dinner',25,'2025-04-03 16:30:05','recipe_67eeb78dca0f4.jpg',4),(109,'Creamy Garlic Mushroom Pasta','A comforting pasta dish loaded with garlicky mushrooms in a creamy sauce. Easy to make and deliciously satisfying.',10,20,'Medium','Dinner',25,'2025-04-03 16:37:22','recipe_67eeb94251db5.jpg',2);
/*!40000 ALTER TABLE `recipes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_favourites`
--

DROP TABLE IF EXISTS `user_favourites`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_favourites` (
  `users_userID` int(11) NOT NULL,
  `recipes_recipeID` int(11) NOT NULL,
  `timeAdded` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`users_userID`,`recipes_recipeID`),
  KEY `fk_users_has_recipes_recipes1_idx` (`recipes_recipeID`),
  KEY `fk_users_has_recipes_users1_idx` (`users_userID`),
  CONSTRAINT `fk_users_has_recipes_recipes1` FOREIGN KEY (`recipes_recipeID`) REFERENCES `recipes` (`recipeID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_has_recipes_users1` FOREIGN KEY (`users_userID`) REFERENCES `users` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_favourites`
--

LOCK TABLES `user_favourites` WRITE;
/*!40000 ALTER TABLE `user_favourites` DISABLE KEYS */;
INSERT INTO `user_favourites` VALUES (1,31,'2025-04-01 13:23:44'),(1,63,'2025-04-01 17:17:41'),(1,80,'2025-04-01 12:16:34'),(1,92,'2025-04-02 20:43:58'),(1,109,'2025-04-03 16:38:42'),(10,92,'2025-04-01 19:27:25'),(10,107,'2025-04-03 16:41:05'),(10,108,'2025-04-03 16:39:35'),(25,92,'2025-04-03 15:43:16'),(25,107,'2025-04-03 16:12:36'),(25,109,'2025-04-03 16:37:35');
/*!40000 ALTER TABLE `user_favourites` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_inventory`
--

DROP TABLE IF EXISTS `user_inventory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_inventory` (
  `userID` int(11) NOT NULL,
  `ingredientID` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit` enum('g','kg','oz','lb','l','ml','tsp','tbsp') NOT NULL,
  `expiryDate` datetime DEFAULT NULL,
  PRIMARY KEY (`userID`,`ingredientID`),
  KEY `fk_users_has_ingredients_ingredients1_idx` (`ingredientID`),
  KEY `fk_users_has_ingredients_users1_idx` (`userID`),
  CONSTRAINT `fk_users_has_ingredients_ingredients1` FOREIGN KEY (`ingredientID`) REFERENCES `ingredients` (`ingredientID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_users_has_ingredients_users1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_inventory`
--

LOCK TABLES `user_inventory` WRITE;
/*!40000 ALTER TABLE `user_inventory` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_inventory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `userType` enum('Customer','Administrator') NOT NULL,
  `firstName` varchar(30) DEFAULT NULL,
  `lastName` varchar(30) DEFAULT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(40) NOT NULL,
  `bio` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`userID`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Administrator','Conor','Hanrahan','conorhanrahan01@gmail.com','cf8f0c0d32522bc3d2ebe59d1fa46611d3369c96','If you hate cooking but love making web apps, my recipes are for you!!'),(10,'Customer','Simran','Leithner','simranlvl@me.com','cf8f0c0d32522bc3d2ebe59d1fa46611d3369c96',''),(21,'Customer','Alice','Baker','abaker@mail.com','cf8f0c0d32522bc3d2ebe59d1fa46611d3369c96',''),(23,'Customer','Harry','Doyle','harrydoyle@mail.com','cf8f0c0d32522bc3d2ebe59d1fa46611d3369c96','I LOVE FOOD!!!!'),(24,'Customer','Gina','Rogers','rogersg@gmail.com','cf8f0c0d32522bc3d2ebe59d1fa46611d3369c96','Cant wait to try all these delicous recipes!'),(25,'Administrator','John','Smith','jsmith1@mail.com','cf8f0c0d32522bc3d2ebe59d1fa46611d3369c96','');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'k00294416_kitchenmanager'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-04-03 22:23:43
