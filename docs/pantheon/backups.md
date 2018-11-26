# Pantheon backups

when paying for an account, Pantheon provides automatic backups per environment. But, if you don't pay for the account, there is no automation. Here is a way to fix it.

- Connect to raspberry pi 10.1.16.105. This must be done in the office or on the BC VPN.<br>
  `ssh pi@10.1.16.105`
- goto the bin directory<br>
  `cd /usr/local/bin`
- Set up files for you project and envirnoments. Filenames should be [project]-[env]-[frequency]

Copy project-live-daily cron job for live, test, dev