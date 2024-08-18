select
    picture_id
    ,count(1)
 from picture_item
group by picture_id;

-- 3303
select
    pic_category_id
     ,count(1)
from picture_item a
left  join picture b on a.picture_id = b.id
group by pic_category_id;
