INSERT INTO `picture_category` VALUES (1,'搞笑',1,0,UNIX_TIMESTAMP(),UNIX_TIMESTAMP());

INSERT INTO `picture` VALUES
  (1,1,'卖家','你胸怎么那么大？',1,1,2,10,10,10,10,10,1,UNIX_TIMESTAMP(),UNIX_TIMESTAMP()),
  (2,1,'摩的','输在哪了？',1,1,1,10,10,10,10,10,1,UNIX_TIMESTAMP(),UNIX_TIMESTAMP()),
  (3,1,'聊天','技术那么菜',1,1,1,10,10,10,10,10,1,UNIX_TIMESTAMP(),UNIX_TIMESTAMP());



INSERT INTO `picture_item` VALUES
(1,1,'https://pic2.zhimg.com/v2-da271bb4be502fe00d1465d70bd7fdb5_b.jpg',1,1,1,1,UNIX_TIMESTAMP(),UNIX_TIMESTAMP()),
(2,1,'https://pic3.zhimg.com/v2-602571a4831c4116421a77f2bb35e876_b.jpg',1,1,1,1,UNIX_TIMESTAMP(),UNIX_TIMESTAMP()),
(3,2,'https://pic1.zhimg.com/v2-0a006b32f2c6288d787e4f10b6fe5068_b.jpg',1,1,1,1,UNIX_TIMESTAMP(),UNIX_TIMESTAMP()),
(4,3,'https://pic2.zhimg.com/v2-6f658e4069d5b2ad271edae182237d51_b.jpg',1,1,1,1,UNIX_TIMESTAMP(),UNIX_TIMESTAMP());

INSERT INTO `picture_describe` VALUES
(1,1,'买家秀',UNIX_TIMESTAMP()),
(2,2,'吐槽',UNIX_TIMESTAMP()),
(3,2,'聊天技巧',UNIX_TIMESTAMP());
