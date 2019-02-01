#!/usr/bin/env groovy


// plan - get pipeline building on jenkins push to artifactory/docker, run there, get it working in docker. evaluate if it meets needs
// issue - jenkins pull scm from tf setup with svnf
node {
    // there is a place in jenkins to specify the branch to checkout.
    checkout scm // nothing more required as it is just files

    // Define git short commit to be used in Docker image tag.
    env.GIT_SHORT_COMMIT = sh(returnStdout: true, script: "git log -n 1 --pretty=format:'%h'").trim()

    stage('Build Container') {

        docker.withRegistry('https://registry.hub.docker.com', 'docker_registry') {
          // Web Image
          def frontendImage = docker.build("hub.docker.com/alltiersolutions/kubernetes-lamp-demo-web:${env.GIT_SHORT_COMMIT}", '--no-cache --pull ./frontend')
          frontendImage.push()
          //frontendImage.push('latest')
          // DB Image
          def backendImage = docker.build("hub.docker.com/alltiersolutions/kubernetes-lamp-demo-db:${env.GIT_SHORT_COMMIT}", '--no-cache --pull ./backend')
          backendImage.push()
          //backendImage.push('latest')
        }
      }
    stage('Push to cluster') {
         kubernetesDeploy configs: 'deploy/kubernetes-lamp-demo-web.yaml', kubeConfig: [path: ''], kubeconfigId: 'kube_config_alltiersolutions', secretName: '', ssh: [sshCredentialsId: '*', sshServer: ''], textCredentials: [certificateAuthorityData: '', clientCertificateData: '', clientKeyData: '', serverUrl: 'https://']
         kubernetesDeploy configs: 'deploy/kubernetes-lamp-demo-db.yaml', kubeConfig: [path: ''], kubeconfigId: 'kube_config_alltiersolutions', secretName: '', ssh: [sshCredentialsId: '*', sshServer: ''], textCredentials: [certificateAuthorityData: '', clientCertificateData: '', clientKeyData: '', serverUrl: 'https://']
      }

    stage('Cleanup Docker') {
      sh 'docker system prune -f'
    }

}
