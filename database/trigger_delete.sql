CREATE TRIGGER IF NOT EXISTS TriggerDelete
AFTER DELETE ON User
FOR EACH ROW
BEGIN


DELETE FROM Publication
   WHERE Publication.username = old.username;


DELETE FROM Comment
   WHERE Comment.username = old.username;


DELETE FROM UserLikesChannel
WHERE UserLikesChannel.username_user = old.username;



DELETE FROM UpVote
   WHERE UpVote.username = old.username;



DELETE FROM DownVote
   WHERE UpVote.username = old.username;


END
