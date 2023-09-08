<?php

namespace App\Console\Commands;

use App\Services\RSSReaderVnexpress;
use Illuminate\Console\Command;

class RunRSSFeedReader extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:run-rss-feed-reader {source}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run rss feed reader, get content and save to database';

    protected $rssReaderVnexpress;

    /**
     * construct function
     *
     * @return void
     */
    public function __construct(RSSReaderVnexpress $rssReaderVnexpress) {
        parent::__construct();
        $this->rssReaderVnexpress = $rssReaderVnexpress;
    }

    /**
     * Execute the console command.
     */
    public function handle() {
        $source = $this->argument('source');

        switch ($source) {
        case 'vnexpress':
            $this->rssReaderVnexpress->run();
            break;
        default:
            $this->error('Source not found');
            break;
        }
    }
}
