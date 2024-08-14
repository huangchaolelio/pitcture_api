desc banner;
insert into admin_users(``.admin_users.id, ``.admin_users.username, ``.admin_users.password, ``.admin_users.name, ``.admin_users.avatar, ``.admin_users.remember_token, ``.admin_users.created_at, ``.admin_users.updated_at)
values (
           1,"admin","admin","test_name","test_avatar","","2024-08-08","2024-08-08"
       );

select * from wechat_app;

select * from picture_db.admin_users;


# select * from mall_pms.pms_sku
select * from picture_db.banner;

select * from picture_db.picture;


# update

select * from picture_db.picture_category;

update   picture_db.picture set title='美女',`describe`='pinerst的图片',item_count= 2,pic_category_id =16
where id = 348;

select * from picture_db.picture_item;

    select * from picture_db.picture_category;

update picture_db.picture_item set url
    = 'https://i.pinimg.com/originals/8d/a5/73/8da573b69498901abdbfc12d16006800.jpg'
where id=1934;

select * from picture_db.picture;

insert into picture_db.picture( user_id, title, `describe`, pic_category_id, device_type, item_count, score, download, collect, `like`, visit, is_show, created_time, updated_time)
# values (1,"pinerst","pinerst的图片",17,1,2,10,10,10,10,10,1,0,0);
values (1,"豪车","pinerst的图片",17,1,1,10,10,10,10,10,1,0,0);


insert into picture_db.picture_item( picture_id, url, download, collect, is_show, oss_tag, created_time, updated_time)
values (348,"https://i.pinimg.com/originals/bf/64/ce/bf64ceebdf361799f1b9913f3ee0312d.jpg",1,1,1,1,0,0);

insert into picture_db.picture_item( picture_id, url, download, collect, is_show, oss_tag, created_time, updated_time)
values (348,"https://i.pinimg.com/originals/cb/77/8e/cb778ed7543101975a1ddf8d68a200e0.jpg",1,1,1,1,0,0);



insert into picture_db.picture_item( picture_id, url, download, collect, is_show, oss_tag, created_time, updated_time)
values (349,"https://i.pinimg.com/originals/c1/bf/80/c1bf801132cd10b8f09aff1c34f97126.jpg",1,1,1,1,0,0);

select * from picture_db.users;

# select * from mall_ums.ums_member

insert into picture_db.users(id, openid, nickname, mobile, email, avatar_url, gender, age, birthday, score, name, remark, disable, created_time, updated_time)
values (1,"openid_oUBUG5hAB_8EMrSaqd2HjJQBFg74","test_user","18691849650","349354786@qq.com","https://thirdwx.qlogo.cn/mmopen/vi_32/J31cY2qVWviaOqhjPlr18VY5ic1SUvDESG1mQkicQfFugWibYe7VJIhYJBZYDBib0T4TJVhUOtiaW1TGkJRqIWd3K0dQ/132",1,"18","2024-08-08",100,"sher","sherlock",1,0,0)




select * from users;
