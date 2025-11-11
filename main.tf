terraform {
  required_providers {
    docker = {
      source = "kreuzwerker/docker"
    }
  }
  required_version = ">= 0.12"
}

module "db_connection" {
  source = "./db"
}

resource "docker_container" "wordpress" {
  name    = "wordpress"
  image   = "wordpress:php8.2-fpm"
  restart = "always"

  depends_on = [ module.db_connection ]
  
  networks_advanced {
    name         = module.db_connection.network_name
    ipv4_address = "10.0.200.2"
  }
  
  mounts {
    source      = abspath("${path.module}/wordpress")
    target = "/var/www/html"
    type = "bind"
  }

  env = [
    "WORDPRESS_DB_HOST=${module.db_connection.db_host}",
    "WORDPRESS_DB_USER=${module.db_connection.db_user}",
    "WORDPRESS_DB_PASSWORD=${module.db_connection.db_password}",
    "WORDPRESS_DB_NAME=${module.db_connection.db_name}",
  ]
}
resource "docker_container" "wp-nginx" {
  name    = "wp-nginx"
  image   = "nginx:alpine"
  restart = "always"

  depends_on = [ docker_container.wordpress ]

  ports {
    internal = 80
    external = 8080
  }
  
  networks_advanced {
    name         = module.db_connection.network_name
    ipv4_address = "10.0.200.3"
  }
  
  mounts {
    source      = abspath("${path.module}/wordpress")
    target = "/var/www/html"
    type = "bind"
  }
  
  mounts {
    source      = abspath("${path.module}/nginx.conf")
    target = "/etc/nginx/conf.d/default.conf"
    type = "bind"
  }
}