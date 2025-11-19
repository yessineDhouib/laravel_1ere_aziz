<?php

namespace App\Filament\Resources;
use Filament\Widgets\StatsOverviewWidget\Card;
use App\Filament\EmployeeResource\Widgets;
use App\Filament\Resources\EmployeeResource\Pages;
use App\Filament\Resources\EmployeeResource\Pages\ListEmployees;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\TextColumn;
use App\Filament\Resources\EmployeeResource\Widgets\EmployeeStatsOverview;
use Filament\Forms\Components\TextInput;
use App\Filament\Resources\EmployeeResource\RelationManagers;
use App\Models\Employee;
use App\Models\Department;
use App\models\country;
use App\models\state;
use App\models\city;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make() 
    ->schema([      
        Select::make('country_id')
        ->label('country')
        ->options(country::all()->pluck('name','id')->toArray())
        ->required()
        ->reactive()
        ->afterStateUpdated(fn(callable $set)=>$set('state_id', null)),
        select::make('state_id')
        ->label('state')
        ->required()
        ->options(function(callable $get){
            $country = country::find($get('country_id'));
            if(!$country){
                return state::all()->pluck('name','id');
            }
            return $country->states->pluck('name','id');
        })
        ->reactive(),
        select::make('city_id')
        ->label('city')
        ->required()
        ->options(function(callable $get){
            $state = state::find($get('state_id'));
            if(!$state){
                return city::all()->pluck('name','id');
            }
            return $state->cities->pluck('name','id');
        })
        ->reactive(),
        select::make('department_id')
        ->label('department')
        ->required()
        ->options(function(callable $get){
            $city = city::find($get('city_id'));
            if(!$city){
                return department::all()->pluck('name','id');
            }
            return $city->departments->pluck('name','id');
        })
        ->reactive() ,
            TextInput::make('first_name')->required()->maxLength(255),
            TextInput::make('last_name')->required()->maxLength(255),
            TextInput::make('adress')->required()->maxLength(255),
            TextInput::make('zip_code')->required()->maxLength(6),
            DatePicker::make('birth_date')->required(),
            DatePicker::make('date_hired')->required(),        
    ])
    ]);
}
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('first_name')->sortable()->searchable(),
                TextColumn::make('last_name')->sortable()->searchable(),
                TextColumn::make('department.name')->sortable()->searchable(),
                TextColumn::make('date_hired')->date(),
                TextColumn::make('created_at')->dateTime()
            ])
            ->filters([
                SelectFilter::make('department')->relationship('department', 'name')
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    public static function getWidgets(): array
    {
        return [
            EmployeeStatsOverview::class,
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployee::route('/create'),
            'edit' => Pages\EditEmployee::route('/{record}/edit'),
        ];
    }    
}
