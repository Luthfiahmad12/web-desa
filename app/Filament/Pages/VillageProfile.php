<?php

namespace App\Filament\Pages;

use App\Models\Profile;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Support\Enums\Alignment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class VillageProfile extends Page
{

    protected static ?string $title = 'Profile Desa';

    protected static string $view = 'filament.pages.village-profile';

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $navigationGroup = 'Setting';

    protected static ?int $navigationSort = 1;

    public static bool $shouldRegisterNavigation = true;

    public ?array $data = [];

    public ?Model $village;

    public function mount(): void
    {
        $this->village = Profile::first();

        $this->form->fill(
            $this->village->toArray()
        );
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->prefix('Desa')
                    ->label('Nama')
                    ->required(),
                FileUpload::make('image')
                    ->image()
                    ->disk('public'),
                Textarea::make('content')
                    ->required()
                    ->label('Deskripsi')
                    ->columnSpanFull()
            ])
            ->statePath('data')
            ->model($this->village);
    }

    public function getFormActions()
    {
        return [
            Action::make('Update')
                ->color('primary')
                ->submit('Update'),
        ];
    }

    public function update()
    {
        $data = $this->form->getState();

        if (!empty($data['image']) && !empty($this->village->image)) {
            Storage::disk('public')->delete($this->village->image);
        }

        $this->village->update($data);

        Notification::make()
            ->title('Profile desa berhasil di update!')
            ->success()
            ->send();
    }
}
