# Task for Supermetrics

`index.php` is a little console script, just run it.
HTML interface is not needed by the task, so why not console script? :)

## Possible commands

1) `php index.php login`
Receives token with credentials from .env file. This token must be placed
to .env variable **API_TOKEN**. In real world application, of course,
token would be auto refreshed with refresh token, but I think this solution
is ok for this kind of task.

2) `php index.php statistics`
Receives statisctics and saves it tojson file. Fileppath will be printed in the console.
