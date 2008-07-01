# Prevent mixing up of user data after switching registration type
# Query 1: Find customers with no associated Joomla! user account
CREATE TEMPORARY TABLE dummyusers AS SELECT user_id
FROM `jos_vm_user_info` LEFT JOIN jos_users ON id = user_id WHERE id IS NULL AND user_id >62;
# Query 2: Make sure that the user_id of "dummy users" won't ever become one of a registered user and set a value < 62
UPDATE jos_vm_user_info as ui,dummyusers  as du SET ui.user_id=(124-ABS(`ui`.`user_id`)) WHERE ui.user_id=du.user_id;