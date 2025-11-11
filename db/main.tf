
terraform {
  required_providers {
    docker = {
      source = "kreuzwerker/docker"
    }
  }
  required_version = ">= 0.12"
}


variable "MYSQL_ROOT_PASSWORD" {
  default = "myStrongPassword123"
}

variable "MYSQL_DATABASE" {
  default = "school_1"
}

variable "MYSQL_USER" {
  default = "user1"
}

variable "MYSQL_PASSWORD" {
  default = "myStrongPassword1234"
}

module "wp_network" {
  source = "./../network"
}

resource "docker_container" "wp-db" {
  name    = "wp-db"
  image   = "mysql:8"
  restart = "always"

  depends_on = [module.wp_network]
  
  networks_advanced {
    name         = module.wp_network.network_name
    ipv4_address = "10.0.200.1"
  }
  

  ports {
    internal = 3306
    external = 3307
  }
  

  env = [
    "MYSQL_ROOT_PASSWORD=${var.MYSQL_ROOT_PASSWORD}",
    "MYSQL_DATABASE=${var.MYSQL_DATABASE}",
    "MYSQL_USER=${var.MYSQL_USER}",
    "MYSQL_PASSWORD=${var.MYSQL_PASSWORD}",
  ]
}

output "network_name" {
  value = one(docker_container.wp-db.networks_advanced).name
}

output "db_host" {
  value = one(docker_container.wp-db.networks_advanced).ipv4_address
}

output "db_name" {
  value = var.MYSQL_DATABASE
}

output "db_user" {
  value = var.MYSQL_USER
}

output "db_password" {
  value = var.MYSQL_PASSWORD
}

output "db_port" {
  value = docker_container.wp-db.ports[0].external
}