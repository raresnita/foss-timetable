<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\CourseUpdate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Notification;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

    public function notificationToGroup(Request $request){
        $validated = $request->validate([
            'group_id' => 'required|exists:groups,id',
            'message'  => 'required|string|max:500',
        ]);

        // Luăm toți studenții care aparțin de grupa selectată
        $students = User::where('group_id', $validated['group_id'])
            ->where('user_role', 'stud') // să fii sigur că nu trimiți și altor profi din grupă
            ->get();

        // Profesorul care trimite este user-ul logat
        $professor = auth()->user();

        // Trimitere în masă
        Notification::send($students, new CourseUpdate($professor, $validated['message'], $validated['group_id']));

        return back()->with('status', 'Anunțul a fost trimis cu succes către grupă!');
    }
}
