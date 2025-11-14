
terraform {
  required_providers {
    docker = {
      source = "kreuzwerker/docker"
    }
  }
  required_version = ">= 0.12"
}
resource "docker_network" "wp_network" {
  name       = "wordpress_network"
  driver     = "bridge"
  attachable = true

  ipam_config {
    subnet  = "10.0.200.0/24"
    gateway = "10.0.200.254"
  }
}
output "network_name" {
  value = docker_network.wp_network.name
}