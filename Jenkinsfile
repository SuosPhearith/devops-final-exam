pipeline {
    agent any
    
    environment {
        HOME = '/var/www/html'  // Example path where Laravel project is located
        COMPOSER_HOME = "${HOME}/.composer"
        PATH = "/usr/local/bin:$PATH"
    }
    
    tools {
        // Ensure PHP and Composer are available tools in Jenkins Global Tool Configuration
        php 'PHP'  // Specify PHP tool defined in Jenkins
        composer 'Composer'  // Specify Composer tool defined in Jenkins
    }

    stages {
        stage('Checkout') {
            steps {
                // Checkout Laravel project from Git repository
                git branch: 'main', url: 'https://github.com/SuosPhearith/devops-final-exam.git'
            }
        }

        stage('Install Dependencies') {
            steps {
                // Install PHP dependencies using Composer
                sh 'composer install --no-ansi --no-interaction --no-progress --optimize-autoloader'
            }
        }

        stage('Run Tests') {
            steps {
                // Execute Laravel tests (adjust this command based on your test framework)
                sh 'php artisan test'
            }
        }

        stage('Build Assets') {
            steps {
                // If your Laravel project includes frontend assets (e.g., npm, yarn), install and build them here
                // Example with npm:
                sh 'npm install'
                sh 'npm run production'  // Adjust as per your Laravel project's build script
            }
        }

        stage('Deploy') {
            when {
                branch 'master'  // Deploy only when changes are made to the master branch
            }
            steps {
                // Example deployment steps (customize based on your deployment strategy)
                sh 'php artisan migrate --force'  // Example: migrate database on deploy
                sh 'php artisan config:cache'    // Example: cache configuration
                // Add more deployment steps as needed
            }
        }
    }

    post {
        always {
            // Cleanup steps or additional notifications can be added here
        }
        
        success {
            // Send email notification for success
            emailext (
                to: 'recipient@example.com',
                subject: 'Pipeline Success',
                body: 'Your Jenkins pipeline has completed successfully.'
            )
        }
        
        failure {
            // Send email notification for failure
            emailext (
                to: 'recipient@example.com',
                subject: 'Pipeline Failure',
                body: 'Your Jenkins pipeline has failed. Please check the logs for details.'
            )
        }
    }
}