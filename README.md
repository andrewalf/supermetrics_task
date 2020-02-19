# Task for Supermetrics

`index.php` is a little console script, just run it.
HTML interface is not needed by the task, so why not console script? :)

## Possible commands

`php index.php login` - receive token
Receives token with credentials from .env file. This token must be placed
to .env variable **API_TOKEN**. In real world application, of course,
token would be auto refreshed with refresh token, but I think this solution
is ok for this kind of task.

`php index.php statistics` - receive statistics