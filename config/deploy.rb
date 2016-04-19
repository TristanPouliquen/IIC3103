# config valid only for current version of Capistrano
lock '3.4.1'

set :application, 'proyecto-10'
set :repo_url, 'git@github.com:TristanPouliquen/IIC3103-Proyecto10.git'

set :ssh_user, "administrator"
server "integra10.ing.puc.cl", user: fetch(:ssh_user), roles: %w{web app db}

set :composer_install_flags, '--no-dev --prefer-dist --no-interaction --optimize-autoloader'

# Default value for :linked_files is []
set :linked_files, ["app/config/parameters.yml"]

# Default value for linked_dirs is []
set :linked_dirs, ["vendor", "var/logs"]

set :file_permissions_paths, ["var/logs", "var/cache"]
set :file_permissions_users, ["www-data"]
set :permission_method, :acl

namespace :deploy do
  task :migrate do
  	on roles(:all) do
    	symfony_console('doctrine:migrations:migrate', '--no-interaction')
    end
  end
end

after 'deploy:updated', 'deploy:migrate'
