<?php

namespace App\Forms\Components;

use Filament\Forms\Components\FileUpload;
use Livewire\TemporaryUploadedFile;

class CustomFileUpload extends FileUpload
{
    public function removeUploadedFile(string $fileKey): string | TemporaryUploadedFile | null
    {
        $return = parent::removeUploadedFile(fileKey: $fileKey);

        // set state to null if the user reverted his uploaded file
        // therefore the image name isn't sent with the request when the user clicks the submit button
        if (! ($this->getState()[$fileKey] ?? null)) {
            $this->state(null); // <-- this resolves the issue
        }

        return $return;
    }
}
