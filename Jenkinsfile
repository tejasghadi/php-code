// This is a pipeline for Jenkins (launched on aws ec2 ubuntu instance) to fetch php code from Github and then transfer it to the
// Apache2 /var/www/html directory (deployment)onto the another aws ec2 ubuntu instance.



pipeline {
    agent any
      
        tools {
              jdk "Java-1.8"
               }
    
       stages {
            stage('SCM checkout') {
                  steps {
                        git url: 'https://github.com/Anusha-DevOp/CI-CD-for-PHP.git'
                        }
             }
             
             stage('archiving artifacts') {
                  steps {
                          archiveArtifacts '**/*.html'
                        }
              }
              
              stage('transfer artifacts') {
                    steps {
                          sshPublisher(publishers: [sshPublisherDesc(configName: 'MyApacheInstance', transfers: [sshTransfer(excludes: '', execCommand: '', execTimeout: 120000, flatten: true, makeEmptyDirs: false, noDefaultExcludes: false, patternSeparator: '[, ]+', remoteDirectory: '/var/www/html', remoteDirectorySDF: false, removePrefix: '', sourceFiles: '**/*.html')], usePromotionTimestamp: false, useWorkspaceInPromotion: false, verbose: true)])
                          }
              }
       }
}
