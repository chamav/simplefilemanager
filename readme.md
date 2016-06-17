# Simple file manager application powered by laravel 5.2

Have Vagrantfile used virtulabox.
Before launching your Homestead environment, you must install VirtualBox and Vagrant.
But you need to add the correct settings in configure file /homestead/Homestead.yaml

> folders:
>     - map: ~/projects
>       to: /home/vagrant/projects

and

> sites:
>     - map: filemanager.app
>       to: /home/vagrant/projects/filemanager/public

Once you have edited the Homestead.yaml to your liking, run the vagrant up command from your Homestead directory.
Vagrant will boot the virtual machine and automatically configure your shared folders and Nginx sites.

To destroy the machine, you may use the vagrant destroy --force command.

https://laravel.com/docs/5.2/homestead
