<?php

namespace Domain\Spam\Actions;


use Domain\Source\Models\Source;
use Domain\Spam\Events\SourceReportEvent;
use Domain\Spam\Models\PostReport;
use Domain\User\Models\User;

final class SourceReportAction
{
    public function __invoke(User $user, Source $source, string $report): void
    {
        $spam = PostReport::create(
            [
                'user_id' => $user->id,
                'source_id' => $source->id,
                'report' => $report
            ]
        );
        event(SourceReportEvent::new($spam));
    }
}