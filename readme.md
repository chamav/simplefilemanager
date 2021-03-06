# Simple file manager application powered by laravel 5.2

Use **composer install**

**php artisan migrate**
If you are using the Homestead (Vagrant) virtual machine, you should run this command from within your VM

Have Vagrantfile used virtulabox.
Before launching your Homestead environment, you must install VirtualBox and Vagrant.
Also you need to add the correct settings in configure file /homestead/Homestead.yaml

```
folders:
    - map: ~/projects
      to: /home/vagrant/projects
```
and
```
sites:
    - map: filemanager.app
      to: /home/vagrant/projects/filemanager/public
```
Once you have edited the Homestead.yaml to your liking, run the **vagrant up** command from your project directory.
Vagrant will boot the virtual machine and automatically configure your shared folders and Nginx sites.

To destroy the machine, you may use the vagrant destroy --force command.

https://laravel.com/docs/5.2/homestead
