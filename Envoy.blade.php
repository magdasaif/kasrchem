@servers(['local' => '127.0.0.1', 'dev' => 'root@66.7.221.45 -p 1157', 'production' => 'root@stillunknownserver -p 1157'])

@setup
    $repo = 'ssh://s3/training/eradco/backend';
    $branch = 'dev';

    date_default_timezone_set('Africa/Cairo');
    $date = date('YmdHis');

    $appDir = '/home/viewmurabba/public_html/training';

    $buildsDir = $appDir . '/backendreleases';

    $deploymentDir = $buildsDir . '/' . $date;

    $serve = $appDir . '/backend';
    $env = $appDir . '/.env';
    $htaccess = $appDir . '/htaccess.txt';
    $storage = $appDir . '/storage';

    $composer = '/opt/cpanel/composer/bin/composer';
    $phpver = 'ea-php74';

    $dbname = 'viewmurabba_trainingeradico';

    $owner = 'viewmurabba';
    $group = 'viewmurabba';

    $productionPort = 1157;
    $productionHost = 'root@66.7.221.45';
@endsetup

@task('build', ['on' => 'local'])
    yarn prod
@endtask

@task('git', ['on' => 'dev'])
    echo "Starting the GIT CLONE Task"
    git clone --depth 1 -b {{ $branch }} "{{ $repo }}" {{ $deploymentDir }}
    echo "GIT CLONE Task Finished Successfully !"
@endtask

@task('setup_links', ['on' => 'dev'])
    echo "Starting the setup_links Task"
    cd {{ $deploymentDir }}

    rsync -rav {{ $deploymentDir }}/storage {{ $storage }}
    rm -rf {{ $deploymentDir }}/storage

    ln -ndsf {{ $env }} {{ $deploymentDir }}/.env
    ln -ndsf {{ $storage }} {{ $deploymentDir }}/storage
    ln -ndsf {{ $storage }}/app/public {{ $deploymentDir }}/public/storage
    ln -ndsf {{ $htaccess }} {{ $deploymentDir }}/.htaccess
    echo "setup_links Task Finished Successfully !"
@endtask

@task('install', ['on' => 'dev'])
    echo "Starting the Composer install Task"
    runuser -l {{ $user }} -c "cd {{ $deploymentDir }}; {{ $phpver }} {{ $composer }} install --prefer-dist --no-dev" || echo "Composer Task Doesn\'t Complete successfully !!, It needs some investigation."
    echo "Composer Install Task Finished Successfully !"
@endtask

@task('assets', ['on' => 'local'])
    echo "Starting the Assets SCP Task"
    scp -P{{ $productionPort }} -qr public/css {{ $productionHost }}:{{ $deploymentDir }}/public
    scp -P{{ $productionPort }} -qr public/js {{ $productionHost }}:{{ $deploymentDir }}/public
    scp -P{{ $productionPort }} -q public/mix-manifest.json {{ $productionHost }}:{{ $deploymentDir }}/public
    echo "Assets SCP Task Finished Successfully !"
@endtask

@task('live', ['on' => 'dev'])
    echo "Starting LIVE symlink Task"
    [[ -h {{ $serve }} ]] && unlink {{ $serve }}
    runuser -l {{ $user }} -c "ln -ndsf {{ $deploymentDir }} {{ $serve }}"
    chown {{ $owner }}:{{ $group }} -R {{ $appDir }}
    echo "LIVE symlink Task Finished Successfully !"
@endtask

@task('ownership', ['on' => 'dev'])
    echo "Starting OwnerShip Setup Task"
    chown {{ $owner }}:{{ $group }} -R {{ $deploymentDir }}
    find {{ $deploymentDir }} -type d -exec chmod 755 {} \;
    find {{ $deploymentDir }} -type f -exec chmod 644 {} \;
    echo "OwnerShip Setup Task Finished Successfully !"
@endtask

@task('db_migrate', ['on' => 'dev'])
    echo "Starting db_migrate Task"
    cd {{ $deploymentDir }}
    {{ $phpver }} artisan schema:dump || echo "There is some issue in creating full structure dump of the database using schema:dump command"
    mysqldump --complete-insert --lock-all-tables --extended-insert --insert-ignore {{ $dbname }} > ./{{ $dbname }}_full.sql || echo "There is some issue in creating full dump of the database"
    mysqldump --complete-insert --lock-all-tables --extended-insert --no-create-db --no-create-info --insert-ignore {{ $dbname }} > ./{{ $dbname }}_dataonly.sql || echo "There is some issue in creating a dataonly dump of the database"
    runuser -l {{ $user }} -c "cd {{ $deploymentDir }}; {{ $phpver }} {{ $composer }} install --prefer-dist --no-dev" || echo "Composer Task Doesn\'t Complete successfully !!, It needs some investigation."
    {{ $phpver }} artisan migrate || echo 'There is some issue Migrating the db'
    {{ $phpver }} artisan db:seed || echo 'There is no data to seed into the db'
    mysql {{ $dbname }} < {{ $dbname }}_dataonly.sql || echo "There is some issue restoring previous data dumped"
    echo "db_migrate Task Finished Successfully !"
{{--
//     mysql {{ $dbname }} < {{ $dbname }}_full.sql
//     {{ $phpver }} artisan db:seed || echo 'There is some issue seeding the db'
//     for table in $(( {{ $phpver }} artisan migrate:status | egrep 'No' | awk '{print $4}' | sed 's/$/.php/' ))
//     do
//     ( mysqldump --add-drop-table --no-data {{ $dbname }} | egrep 'DROP TABLE' ) > ./{{ $dbname }}_drop_all_tables.sql || echo "There is some issue in creating a drop all tables dump of the database"
//         echo 'Migrating {{ $table }}'
//         {{ $phpver }} artisan migrate --path={{ $serve }}/database/migrations/{{ $table }} --seed --force || echo 'There is some issue Migrating the the table {{ $table }}'
//     echo "{{ $dbname }}"| xargs -I{} sh -c "mysql -Nse 'show tables' {}| xargs -I[] mysql -e 'SET FOREIGN_KEY_CHECKS=0; drop table []' {}"
//     done
//     mysql {{ $dbname }} < ./{{ $dbname }}_drop_all_tables.sql
    --}}
@endtask

@task('update_storage_path', ['on' => 'dev'])
    echo "Starting update_storage_path Task"
    cd {{ $serve }}
    runuser -l {{ $user }} -c "cd {{ $deploymentDir }};{{ $phpver }} artisan storage:link" || true
    echo "update_storage_path Task Finished Successfully !"
@endtask

@task('Clear_Cache', ['on' => 'dev'])
    echo "Starting Clear_Cache Task"
    runuser -l {{ $user }} -c "cd {{ $deploymentDir }};{{ $phpver }} artisan cache:clear;{{ $phpver }} artisan config:cache;{{ $phpver }} artisan view:clear;" || true
    echo "Clear_Cache Task Finished Successfully !"
@endtask

@story('deploy')
    git
    setup_links
    install
    ownership
    db_migrate
    Clear_Cache
    live
@endstory
