<?php

namespace App\Services;

use App\Exceptions\FileDeletionException;
use App\Models\Employee;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class FileService
{
    /**
     * Upload a file to the specified disk and directory, and optionally process it.
     *
     * @param array $data
     * @param UploadedFile $file
     * @param Employee|null $employee
     * @return array
     */
    public function upload(array $data, UploadedFile $file, ?Employee $employee = null): array
    {
        $extension = $file->getClientOriginalExtension();
        $filename = $data['name'] . '_' . uniqid() . '.' . $extension;
        $file->move(storage_path('app/public/employee-photos'), $filename);
        $data['photo'] = 'employee-photos/' . $filename;

        if ($employee !== null && $employee->photo && $employee->photo !== $data['photo']) {
            $oldPhotoPath = 'public/' . $employee->photo;
            if (Storage::exists($oldPhotoPath)) {
                // Delete the old photo
                $this->delete($oldPhotoPath);
            }
        }

        return $data;
    }

    public function delete(string $path): void
    {
        if (Storage::exists($path)) {
            Storage::delete($path);
        } else {
            $errorMessage = 'File not found: ' . $path;
            session()->flash('error', $errorMessage);
        }
    }
}
