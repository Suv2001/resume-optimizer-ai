# 📝 Smart Resume Optimizer AI

A Laravel-based application with AI capabilities to help users optimize their resumes through automated analysis, feedback, and generation of improved versions.

## � Project Overview

Smart Resume Optimizer AI leverages OpenAI's powerful language models to analyze resumes, provide actionable feedback, and help users create more effective job application documents.

Key features:

- Resume PDF upload and parsing
- AI-powered resume analysis and feedback
- Optimized resume generation
- User authentication and management
- Admin dashboard with Filament
- Modern UI with Tailwind CSS v3
- Dockerized environment
- CI/CD with GitHub Actions

## 📋 Detailed Implementation Plan

### Phase 1: Project Setup and Authentication

#### 1.1 Initial Setup

1. Create GitHub repository

```bash
# Create new repo via GitHub and clone it
git clone https://github.com/your-username/smart-resume-optimizer.git
cd smart-resume-optimizer
```

2. Install Laravel

```bash
composer create-project laravel/laravel .
```

3. Set environment variables

```bash
cp .env.example .env
# Edit .env to set database credentials
php artisan key:generate
```

4. Configure database connection in `.env`

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=resume_optimizer
DB_USERNAME=root
DB_PASSWORD=your_password
```

5. Initial git commit

```bash
git add .
git commit -m "Initial Laravel installation"
git push origin main
```

#### 1.2 Authentication Setup

1. Install Laravel Breeze

```bash
composer require laravel/breeze --dev
php artisan breeze:install blade
```

2. Install and configure Tailwind CSS v3

```bash
npm install -D tailwindcss@^3.0 postcss autoprefixer
npx tailwindcss init -p
```

3. Configure Tailwind (update tailwind.config.js)

```js
/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {},
  },
  plugins: [require('@tailwindcss/forms')],
}
```

4. Setup and build frontend assets

```bash
npm install
npm run dev
```

5. Run migrations

```bash
php artisan migrate
```

### Phase 2: Admin Dashboard with Filament

#### 2.1 Filament Installation

1. Install Filament admin panel

```bash
composer require filament/filament:"^3.0"
```

2. Install Filament panels

```bash
composer require filament/panels:"^3.0"
php artisan filament:install --panels
```

3. Create admin user

```bash
php artisan make:filament-user
```

#### 2.2 Filament Configuration

1. Create admin models and resources

```bash
# User resource
php artisan make:filament-resource User --generate

# Other resources will be created in later phases
```

2. Customize admin theme (optional)

```bash
php artisan vendor:publish --tag=filament-config
# Edit config/filament.php as needed
```

### Phase 3: Resume Model and File Upload System

#### 3.1 Resume Model Creation

1. Create Resume model and migration

```bash
php artisan make:model Resume -m
```

2. Update resume migration file

```php
// database/migrations/xxxx_xx_xx_create_resumes_table.php
Schema::create('resumes', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->string('original_name');
    $table->string('file_path');
    $table->string('file_type');
    $table->integer('file_size');
    $table->text('extracted_text')->nullable();
    $table->json('ai_feedback')->nullable();
    $table->json('optimized_content')->nullable();
    $table->enum('status', ['uploaded', 'processing', 'completed', 'failed']);
    $table->timestamps();
});
```

3. Define Resume model with relationships

```php
// app/Models/Resume.php
public function user()
{
    return $this->belongsTo(User::class);
}

protected $fillable = [
    'user_id', 'original_name', 'file_path', 
    'file_type', 'file_size', 'extracted_text', 
    'ai_feedback', 'optimized_content', 'status'
];

protected $casts = [
    'ai_feedback' => 'array',
    'optimized_content' => 'array'
];
```

4. Update User model relationship

```php
// app/Models/User.php
public function resumes()
{
    return $this->hasMany(Resume::class);
}
```

#### 3.2 File Upload System

1. Create controller for resume uploads

```bash
php artisan make:controller ResumeController
```

2. Create storage symlink

```bash
php artisan storage:link
```

3. Update the storage configuration

```php
// config/filesystems.php
'resumes' => [
    'driver' => 'local',
    'root' => storage_path('app/public/resumes'),
    'url' => env('APP_URL').'/storage/resumes',
    'visibility' => 'public',
]
```

4. Create upload form in Blade views

```php
// resources/views/resumes/upload.blade.php
<form action="{{ route('resumes.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-4">
        <label for="resume" class="block text-sm font-medium text-gray-700">Upload Resume (PDF only)</label>
        <input id="resume" name="resume" type="file" accept=".pdf" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
        @error('resume')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>
    <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
        Upload
    </button>
</form>
```

5. Create routes for resume management

```php
// routes/web.php
Route::middleware(['auth'])->group(function () {
    Route::resource('resumes', ResumeController::class);
    Route::get('resumes/{resume}/download', [ResumeController::class, 'download'])->name('resumes.download');
    Route::get('resumes/{resume}/view-analysis', [ResumeController::class, 'viewAnalysis'])->name('resumes.view-analysis');
});
```

6. Implement controller methods for file handling

```php
// app/Http/Controllers/ResumeController.php
public function store(Request $request)
{
    $request->validate([
        'resume' => 'required|file|mimes:pdf|max:5120', // 5MB max
    ]);

    $file = $request->file('resume');
    $fileName = time() . '_' . $file->getClientOriginalName();
    $file->storeAs('resumes', $fileName, 'public');

    $resume = auth()->user()->resumes()->create([
        'original_name' => $file->getClientOriginalName(),
        'file_path' => 'resumes/' . $fileName,
        'file_type' => $file->getClientMimeType(),
        'file_size' => $file->getSize(),
        'status' => 'uploaded'
    ]);

    // We'll dispatch a job to process this resume later

    return redirect()->route('dashboard')
        ->with('success', 'Resume uploaded successfully and queued for analysis!');
}
```

7. Create resume list view in dashboard

```php
// resources/views/dashboard.blade.php - Add this section
<div class="mt-8">
    <h2 class="text-lg font-medium text-gray-900">Your Resumes</h2>
    <div class="mt-4 space-y-4">
        @forelse($resumes as $resume)
            <div class="flex items-center justify-between p-4 bg-white rounded-lg shadow">
                <div>
                    <h3 class="text-sm font-medium text-gray-900">{{ $resume->original_name }}</h3>
                    <p class="text-xs text-gray-500">Uploaded: {{ $resume->created_at->diffForHumans() }}</p>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                        {{ $resume->status === 'completed' ? 'bg-green-100 text-green-800' : 
                          ($resume->status === 'failed' ? 'bg-red-100 text-red-800' : 
                          'bg-blue-100 text-blue-800') }}">
                        {{ ucfirst($resume->status) }}
                    </span>
                </div>
                <div class="flex space-x-2">
                    @if($resume->status === 'completed')
                        <a href="{{ route('resumes.view-analysis', $resume) }}" class="text-sm text-blue-600 hover:text-blue-900">View Analysis</a>
                        <a href="{{ route('resumes.download', $resume) }}" class="text-sm text-green-600 hover:text-green-900">Download</a>
                    @endif
                </div>
            </div>
        @empty
            <p class="text-sm text-gray-500">You haven't uploaded any resumes yet.</p>
        @endforelse
    </div>
</div>
```

8. Update dashboard controller to include resumes

```php
// app/Http/Controllers/DashboardController.php
public function index()
{
    $resumes = auth()->user()->resumes()->latest()->get();
    return view('dashboard', compact('resumes'));
}
```

### Phase 4: AI Integration

#### 4.1 PDF Processing

1. Install PDF parser

```bash
composer require smalot/pdfparser
```

2. Create PDF service for text extraction

```bash
mkdir -p app/Services
```

3. Create PDFService class

```php
// app/Services/PDFService.php
<?php

namespace App\Services;

use Smalot\PdfParser\Parser;
use Exception;

class PDFService
{
    /**
     * Extract text content from a PDF file
     *
     * @param string $filePath Path to the PDF file
     * @return string Extracted text
     */
    public function extractText(string $filePath): string
    {
        try {
            $parser = new Parser();
            $pdf = $parser->parseFile(storage_path('app/public/' . $filePath));
            return $pdf->getText();
        } catch (Exception $e) {
            logger()->error('PDF extraction failed: ' . $e->getMessage());
            throw new Exception('Failed to extract text from resume: ' . $e->getMessage());
        }
    }
}
```

4. Register service in AppServiceProvider

```php
// app/Providers/AppServiceProvider.php
public function register()
{
    $this->app->singleton(PDFService::class, function ($app) {
        return new PDFService();
    });
}
```

#### 4.2 OpenAI Integration

1. Create OpenAI API account at https://platform.openai.com/
2. Add OpenAI configuration to `.env`

```bash
OPENAI_API_KEY=your_api_key_here
OPENAI_MODEL=gpt-3.5-turbo
```

3. Create OpenAI service class

```php
// app/Services/OpenAIService.php
<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Exception;

class OpenAIService
{
    protected $apiKey;
    protected $model;

    public function __construct()
    {
        $this->apiKey = config('services.openai.api_key');
        $this->model = config('services.openai.model', 'gpt-3.5-turbo');
    }

    public function analyzeResume(string $resumeText)
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ])->post('https://api.openai.com/v1/chat/completions', [
                'model' => $this->model,
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => 'You are a professional resume reviewer with expertise in helping people improve their resumes for job applications.'
                    ],
                    [
                        'role' => 'user',
                        'content' => $this->buildPrompt($resumeText)
                    ]
                ],
                'temperature' => 0.7,
                'max_tokens' => 2000
            ]);

            if ($response->failed()) {
                throw new Exception('OpenAI API request failed: ' . $response->body());
            }

            return $response->json();
        } catch (Exception $e) {
            logger()->error('OpenAI API error: ' . $e->getMessage());
            throw $e;
        }
    }

    private function buildPrompt(string $resumeText): string
    {
        return <<<EOT
Please analyze the following resume and provide detailed feedback in JSON format with the following structure:
{
  "summary": "Brief overall assessment of the resume",
  "strengths": ["Strength 1", "Strength 2", "Strength 3"],
  "weaknesses": ["Weakness 1", "Weakness 2", "Weakness 3"],
  "improvements": [
    {
      "section": "Section name (e.g., Experience, Education, Skills)",
      "suggestions": ["Suggestion 1", "Suggestion 2"]
    }
  ],
  "score": 7.5 (Rate on scale of 1-10),
  "keywords_missing": ["keyword1", "keyword2"]
}

Here is the resume text:

$resumeText
EOT;
    }
}
```

4. Update services configuration

```php
// config/services.php - add to the array
'openai' => [
    'api_key' => env('OPENAI_API_KEY'),
    'model' => env('OPENAI_MODEL', 'gpt-3.5-turbo'),
],
```

#### 4.3 Queue System

1. Configure queue driver in `.env`

```
QUEUE_CONNECTION=database
```

2. Create migration for jobs table

```bash
php artisan queue:table
php artisan migrate
```

3. Create resume processing job

```bash
php artisan make:job ProcessResumeJob
```

4. Implement the job

```php
// app/Jobs/ProcessResumeJob.php
<?php

namespace App\Jobs;

use App\Models\Resume;
use App\Services\PDFService;
use App\Services\OpenAIService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Exception;

class ProcessResumeJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $resume;
    public $tries = 2;

    public function __construct(Resume $resume)
    {
        $this->resume = $resume;
    }

    public function handle(PDFService $pdfService, OpenAIService $openAIService)
    {
        try {
            // Update status to processing
            $this->resume->update(['status' => 'processing']);

            // Extract text from PDF
            $extractedText = $pdfService->extractText($this->resume->file_path);
            $this->resume->update(['extracted_text' => $extractedText]);

            // Send to OpenAI for analysis
            $analysis = $openAIService->analyzeResume($extractedText);

            // Store the analysis results
            $this->resume->update([
                'ai_feedback' => $analysis['choices'][0]['message']['content'] ?? null,
                'status' => 'completed'
            ]);

        } catch (Exception $e) {
            $this->resume->update(['status' => 'failed']);
            throw $e;
        }
    }
}
```

5. Dispatch the job when a resume is uploaded

```php
// Update the store method in ResumeController.php
use App\Jobs\ProcessResumeJob;

// At the end of the store method
ProcessResumeJob::dispatch($resume);
```

6. Set up queue worker (for production)

```bash
# Create a supervisor configuration file to manage the queue worker
# /etc/supervisor/conf.d/resume-optimizer-worker.conf

[program:resume-optimizer-worker]
process_name=%(program_name)s_%(process_num)02d
command=php /path/to/your/project/artisan queue:work --sleep=3 --tries=3
autostart=true
autorestart=true
user=www-data
numprocs=2
redirect_stderr=true
stdout_logfile=/path/to/your/project/storage/logs/worker.log
```

7. Create a view to display AI analysis results

```php
// resources/views/resumes/analysis.blade.php
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Resume Analysis
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Analysis for: {{ $resume->original_name }}</h3>
                  
                    @if($resume->status === 'completed' && $resume->ai_feedback)
                        @php $feedback = json_decode($resume->ai_feedback, true) @endphp
                      
                        <div class="mb-6">
                            <h4 class="text-md font-medium mb-2">Summary</h4>
                            <p class="text-gray-700">{{ $feedback['summary'] ?? 'No summary available' }}</p>
                        </div>
                      
                        <div class="mb-6">
                            <h4 class="text-md font-medium mb-2">Strengths</h4>
                            @if(!empty($feedback['strengths']))
                                <ul class="list-disc pl-5">
                                    @foreach($feedback['strengths'] as $strength)
                                        <li class="text-green-600">{{ $strength }}</li>
                                    @endforeach
                                </ul>
                            @else
                                <p>No strengths identified</p>
                            @endif
                        </div>
                      
                        <div class="mb-6">
                            <h4 class="text-md font-medium mb-2">Areas for Improvement</h4>
                            @if(!empty($feedback['weaknesses']))
                                <ul class="list-disc pl-5">
                                    @foreach($feedback['weaknesses'] as $weakness)
                                        <li class="text-red-600">{{ $weakness }}</li>
                                    @endforeach
                                </ul>
                            @else
                                <p>No areas for improvement identified</p>
                            @endif
                        </div>
                      
                        <div class="mb-6">
                            <h4 class="text-md font-medium mb-2">Section Suggestions</h4>
                            @if(!empty($feedback['improvements']))
                                @foreach($feedback['improvements'] as $improvement)
                                    <div class="mb-3">
                                        <h5 class="font-medium">{{ $improvement['section'] }}</h5>
                                        <ul class="list-disc pl-5">
                                            @foreach($improvement['suggestions'] as $suggestion)
                                                <li>{{ $suggestion }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endforeach
                            @else
                                <p>No section suggestions available</p>
                            @endif
                        </div>
                      
                        <div class="mb-6">
                            <h4 class="text-md font-medium mb-2">Overall Score</h4>
                            <div class="flex items-center">
                                <span class="text-2xl font-bold {{ $feedback['score'] >= 7 ? 'text-green-600' : ($feedback['score'] >= 5 ? 'text-yellow-600' : 'text-red-600') }}">
                                    {{ $feedback['score'] ?? 'N/A' }}/10
                                </span>
                            </div>
                        </div>
                    @else
                        <div class="bg-yellow-50 p-4 rounded-md">
                            <p class="text-yellow-700">Analysis is not available yet. Please check back later.</p>
                        </div>
                    @endif
                  
                    <div class="mt-6">
                        <a href="{{ route('dashboard') }}" class="text-blue-600 hover:underline">Back to Dashboard</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
```

8. Add the controller method for displaying analysis

```php
// app/Http/Controllers/ResumeController.php
public function viewAnalysis(Resume $resume)
{
    // Check that the resume belongs to the authenticated user
    if ($resume->user_id !== auth()->id()) {
        abort(403);
    }
  
    return view('resumes.analysis', compact('resume'));
}
```

### Phase 5: Resume Optimization and PDF Generation

#### 5.1 PDF Generation Setup

1. Install DomPDF

```bash
composer require barryvdh/laravel-dompdf
```

2. Publish the config file (optional)

```bash
php artisan vendor:publish --provider="Barryvdh\DomPDF\ServiceProvider"
```

3. Create ResumeGenerationService

```php
// app/Services/ResumeGenerationService.php
<?php

namespace App\Services;

use App\Models\Resume;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class ResumeGenerationService
{
    /**
     * Generate an optimized resume PDF based on AI feedback
     */
    public function generateOptimizedPDF(Resume $resume)
    {
        // Get the AI feedback and extracted text
        $feedback = json_decode($resume->ai_feedback, true);
        $originalText = $resume->extracted_text;
      
        // Create the improved content (this would be another OpenAI call in practice)
        $optimizedContent = $this->createOptimizedContent($resume);
      
        // Store the optimized content
        $resume->update(['optimized_content' => $optimizedContent]);
      
        // Generate PDF
        $pdf = PDF::loadView('pdf.optimized-resume', [
            'resume' => $resume,
            'content' => $optimizedContent,
        ]);
      
        // Save to storage
        $pdfPath = 'resumes/optimized/' . time() . '_' . $resume->id . '.pdf';
        Storage::put('public/' . $pdfPath, $pdf->output());
      
        return $pdfPath;
    }
  
    /**
     * Create optimized content based on AI feedback
     * In a real implementation, this would likely call OpenAI API again
     */
    private function createOptimizedContent(Resume $resume)
    {
        // This is a simplified example - in reality, you'd likely send another
        // request to OpenAI to generate the improved resume content
      
        // For demo, we'll just return a structured array
        return [
            'contact' => [
                'name' => 'Generated from original resume',
                'email' => 'extracted@from.original',
                'phone' => 'Extracted from original',
            ],
            'summary' => 'This is an AI-optimized professional summary based on the original content...',
            'experience' => [
                [
                    'title' => 'Position Title',
                    'company' => 'Company Name',
                    'period' => 'Start - End Date',
                    'description' => 'Improved bullet points would go here...'
                ]
            ],
            'education' => [
                [
                    'degree' => 'Degree',
                    'institution' => 'Institution',
                    'year' => 'Graduation Year'
                ]
            ],
            'skills' => ['Skill 1', 'Skill 2', 'Skill 3']
        ];
    }
}
```

4. Create PDF template view

```php
// resources/views/pdf/optimized-resume.blade.php
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Optimized Resume</title>
    <style>
        body {
            font-family: 'Helvetica', sans-serif;
            color: #333;
            line-height: 1.5;
            margin: 0;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            color: #2563eb;
        }
        .contact-info {
            text-align: center;
            margin-bottom: 20px;
            font-size: 14px;
        }
        .section {
            margin-bottom: 20px;
        }
        .section-title {
            font-size: 16px;
            text-transform: uppercase;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
            margin-bottom: 10px;
            color: #2563eb;
        }
        .experience-item, .education-item {
            margin-bottom: 15px;
        }
        .job-title, .degree {
            font-weight: bold;
            margin-bottom: 3px;
        }
        .company, .institution {
            font-style: italic;
        }
        .period {
            color: #666;
            font-size: 13px;
        }
        .skills-list {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }
        .skill {
            background-color: #f3f4f6;
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 13px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ $content['contact']['name'] ?? 'Professional Resume' }}</h1>
    </div>
  
    <div class="contact-info">
        {{ $content['contact']['email'] ?? '' }} | {{ $content['contact']['phone'] ?? '' }}
    </div>
  
    <div class="section">
        <div class="section-title">Professional Summary</div>
        <p>{{ $content['summary'] ?? 'No summary provided' }}</p>
    </div>
  
    <div class="section">
        <div class="section-title">Experience</div>
        @if (!empty($content['experience']))
            @foreach ($content['experience'] as $job)
                <div class="experience-item">
                    <div class="job-title">{{ $job['title'] }}</div>
                    <div class="company">{{ $job['company'] }}</div>
                    <div class="period">{{ $job['period'] }}</div>
                    <p>{{ $job['description'] }}</p>
                </div>
            @endforeach
        @else
            <p>No experience provided</p>
        @endif
    </div>
  
    <div class="section">
        <div class="section-title">Education</div>
        @if (!empty($content['education']))
            @foreach ($content['education'] as $edu)
                <div class="education-item">
                    <div class="degree">{{ $edu['degree'] }}</div>
                    <div class="institution">{{ $edu['institution'] }}</div>
                    <div class="period">{{ $edu['year'] }}</div>
                </div>
            @endforeach
        @else
            <p>No education provided</p>
        @endif
    </div>
  
    <div class="section">
        <div class="section-title">Skills</div>
        @if (!empty($content['skills']))
            <div class="skills-list">
                @foreach ($content['skills'] as $skill)
                    <span class="skill">{{ $skill }}</span>
                @endforeach
            </div>
        @else
            <p>No skills provided</p>
        @endif
    </div>
</body>
</html>
```

#### 5.2 Resume Download

1. Add generation method to ResumeController

```php
// app/Http/Controllers/ResumeController.php
use App\Services\ResumeGenerationService;

public function generateOptimized(Resume $resume, ResumeGenerationService $generator)
{
    // Check that the resume belongs to the authenticated user
    if ($resume->user_id !== auth()->id()) {
        abort(403);
    }
  
    // Check that the resume has been analyzed
    if ($resume->status !== 'completed') {
        return back()->with('error', 'This resume has not been fully analyzed yet.');
    }
  
    // Generate the optimized PDF
    $pdfPath = $generator->generateOptimizedPDF($resume);
  
    // Store the path
    $resume->update([
        'optimized_path' => $pdfPath
    ]);
  
    return redirect()->route('resumes.view-analysis', $resume)
        ->with('success', 'Optimized resume has been generated!');
}
```

2. Add download method to ResumeController

```php
public function download(Resume $resume)
{
    // Check that the resume belongs to the authenticated user
    if ($resume->user_id !== auth()->id()) {
        abort(403);
    }
  
    // Determine which file to download (original or optimized)
    $filePath = request('type') === 'optimized' 
        ? $resume->optimized_path 
        : $resume->file_path;
  
    if (empty($filePath) || !Storage::disk('public')->exists($filePath)) {
        return back()->with('error', 'File not found.');
    }
  
    // Generate filename for download
    $filename = request('type') === 'optimized' 
        ? 'optimized_' . $resume->original_name 
        : $resume->original_name;
  
    return Storage::disk('public')->download($filePath, $filename);
}
```

3. Add routes for generation and download

```php
// routes/web.php - Add these to the existing authenticated routes group
Route::post('resumes/{resume}/generate', [ResumeController::class, 'generateOptimized'])->name('resumes.generate');
Route::get('resumes/{resume}/download', [ResumeController::class, 'download'])->name('resumes.download');
```

4. Add a button to generate optimized resume

```php
// Add to resources/views/resumes/analysis.blade.php
<div class="mt-8">
    <form action="{{ route('resumes.generate', $resume) }}" method="POST">
        @csrf
        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
            Generate Optimized Resume
        </button>
    </form>
</div>

@if($resume->optimized_path)
    <div class="mt-4">
        <a href="{{ route('resumes.download', ['resume' => $resume, 'type' => 'optimized']) }}" 
           class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Download Optimized Resume
        </a>
    </div>
@endif
```

### Phase 6: Filament Admin Resources

#### 6.1 Resume Resource

1. Create Resume resource for Filament

```bash
php artisan make:filament-resource Resume --generate
```

2. Customize the Resume resource

```php
// app/Filament/Resources/ResumeResource.php
<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ResumeResource\Pages;
use App\Filament\Resources\ResumeResource\RelationManagers;
use App\Models\Resume;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ResumeResource extends Resource
{
    protected static ?string $model = Resume::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->required(),
                  
                Forms\Components\TextInput::make('original_name')
                    ->required()
                    ->maxLength(255),
                  
                Forms\Components\TextInput::make('file_path')
                    ->required()
                    ->maxLength(255),
                  
                Forms\Components\TextInput::make('file_type')
                    ->maxLength(255),
                  
                Forms\Components\TextInput::make('file_size')
                    ->numeric(),
                  
                Forms\Components\Textarea::make('extracted_text')
                    ->columnSpanFull(),
                  
                Forms\Components\Select::make('status')
                    ->options([
                        'uploaded' => 'Uploaded',
                        'processing' => 'Processing',
                        'completed' => 'Completed',
                        'failed' => 'Failed',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->searchable()
                    ->sortable(),
                  
                Tables\Columns\TextColumn::make('original_name')
                    ->searchable(),
                  
                Tables\Columns\TextColumn::make('file_size')
                    ->formatStateUsing(fn (int $state): string => number_format($state / 1024, 2) . ' KB')
                    ->sortable(),
                  
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'danger' => 'failed',
                        'warning' => 'processing',
                        'success' => 'completed',
                        'secondary' => 'uploaded',
                    ]),
                  
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'uploaded' => 'Uploaded',
                        'processing' => 'Processing',
                        'completed' => 'Completed',
                        'failed' => 'Failed',
                    ]),
                  
                Tables\Filters\SelectFilter::make('user')
                    ->relationship('user', 'name'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
  
    public static function getRelations(): array
    {
        return [
            //
        ];
    }
  
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListResumes::route('/'),
            'create' => Pages\CreateResume::route('/create'),
            'view' => Pages\ViewResume::route('/{record}'),
            'edit' => Pages\EditResume::route('/{record}/edit'),
        ];
    }  
}
```

#### 6.2 Dashboard Widgets

1. Create dashboard widgets

```bash
php artisan make:filament-widget StatsOverview --stats-overview
php artisan make:filament-widget LatestResumes
php artisan make:filament-widget ResumeChart --chart
```

2. Implement StatsOverview widget

```php
// app/Filament/Widgets/StatsOverview.php
<?php

namespace App\Filament\Widgets;

use App\Models\Resume;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Users', User::count())
                ->description('Total registered users')
                ->descriptionIcon('heroicon-m-user')
                ->color('primary'),
              
            Stat::make('Total Resumes', Resume::count())
                ->description('Total uploaded resumes')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('success'),
              
            Stat::make('Analyzed Resumes', Resume::where('status', 'completed')->count())
                ->description('Successfully analyzed')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success')
                ->chart(
                    Resume::where('status', 'completed')
                        ->whereBetween('created_at', [now()->subDays(7), now()])
                        ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
                        ->groupBy('date')
                        ->pluck('count')
                        ->toArray()
                ),
              
            Stat::make('Failed Analyses', Resume::where('status', 'failed')->count())
                ->description('Failed to analyze')
                ->descriptionIcon('heroicon-m-x-circle')
                ->color('danger'),
        ];
    }
}
```

3. Implement LatestResumes widget

```php
// app/Filament/Widgets/LatestResumes.php
<?php

namespace App\Filament\Widgets;

use App\Models\Resume;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestResumes extends BaseWidget
{
    protected static ?int $sort = 3;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Resume::query()->latest()->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('User')
                    ->searchable(),
                Tables\Columns\TextColumn::make('original_name')
                    ->label('Resume File'),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'danger' => 'failed',
                        'warning' => 'processing',
                        'success' => 'completed',
                        'secondary' => 'uploaded',
                    ]),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Uploaded')
                    ->dateTime('M d, Y H:i')
                    ->sortable(),
            ]);
    }
}
```

4. Implement ResumeChart widget

```php
// app/Filament/Widgets/ResumeChart.php
<?php

namespace App\Filament\Widgets;

use App\Models\Resume;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class ResumeChart extends ChartWidget
{
    protected static ?string $heading = 'Resume Uploads';
  
    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $data = Trend::model(Resume::class)
            ->between(
                start: now()->subDays(30),
                end: now(),
            )
            ->perDay()
            ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Resume Uploads',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                    'backgroundColor' => '#36a2eb',
                    'borderColor' => '#36a2eb',
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
```

5. Update the Filament configuration

```php
// config/filament.php - Update or add this section
'widgets' => [
    'default' => [
        'App\\Filament\\Widgets\\StatsOverview',
        'App\\Filament\\Widgets\\ResumeChart',
        'App\\Filament\\Widgets\\LatestResumes',
    ],
],
```

#### 6.3 Payment Management (Optional)

1. Create a simple Payment model and migration

```bash
php artisan make:model Payment -m
```

2. Define the migration

```php
// database/migrations/xxxx_xx_xx_create_payments_table.php
Schema::create('payments', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->decimal('amount', 10, 2);
    $table->string('transaction_id')->nullable();
    $table->string('payment_method')->default('razorpay');
    $table->string('status');
    $table->json('metadata')->nullable();
    $table->timestamps();
});
```

3. Create Payment model

```php
// app/Models/Payment.php
protected $fillable = [
    'user_id', 'amount', 'transaction_id', 'payment_method', 'status', 'metadata'
];

protected $casts = [
    'metadata' => 'array'
];

public function user()
{
    return $this->belongsTo(User::class);
}
```

4. Create Filament resource for Payments

```bash
php artisan make:filament-resource Payment --generate
```

### Phase 7: Docker and Development Environment

#### 7.1 Docker Setup

1. Create Dockerfile in project root

```dockerfile
FROM php:8.2-fpm

# Arguments
ARG user=laravel
ARG uid=1000

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system user
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# Set working directory
WORKDIR /var/www

# Install Node.js and npm
RUN curl -sL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# Copy application files
COPY . .

# Set permissions
RUN chown -R $user:$user /var/www
USER $user

# Expose port 9000
EXPOSE 9000
CMD ["php-fpm"]
```

2. Create docker-compose.yml

```yaml
version: '3.8'

services:
  # PHP Application
  app:
    build:
      context: .
      dockerfile: Dockerfile
      args:
        user: laravel
        uid: 1000
    container_name: resume_app
    restart: unless-stopped
    working_dir: /var/www
    volumes:
      - ./:/var/www
    networks:
      - resume-network

  # Nginx Service
  nginx:
    image: nginx:alpine
    container_name: resume_nginx
    restart: unless-stopped
    ports:
      - "80:80"
    volumes:
      - ./:/var/www
      - ./docker/nginx:/etc/nginx/conf.d
    networks:
      - resume-network

  # MySQL Service
  mysql:
    image: mysql:8.0
    container_name: resume_mysql
    restart: unless-stopped
    environment:
      MYSQL_DATABASE: ${DB_DATABASE}
      MYSQL_ROOT_PASSWORD: ${DB_PASSWORD}
      MYSQL_PASSWORD: ${DB_PASSWORD}
      MYSQL_USER: ${DB_USERNAME}
    volumes:
      - mysql_data:/var/lib/mysql
    networks:
      - resume-network

  # Redis Service
  redis:
    image: redis:alpine
    container_name: resume_redis
    restart: unless-stopped
    networks:
      - resume-network

networks:
  resume-network:
    driver: bridge

volumes:
  mysql_data:
    driver: local
```

3. Create Nginx configuration

```bash
mkdir -p docker/nginx
```

4. Create Nginx config file

```nginx
# docker/nginx/app.conf
server {
    listen 80;
    index index.php index.html;
    error_log  /var/log/nginx/error.log;
    access_log /var/log/nginx/access.log;
    root /var/www/public;

    location ~ \.php$ {
        try_files $uri =404;
        fastcgi_split_path_info ^(.+\.php)(/.+)$;
        fastcgi_pass app:9000;
        fastcgi_index index.php;
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        fastcgi_param PATH_INFO $fastcgi_path_info;
    }

    location / {
        try_files $uri $uri/ /index.php?$query_string;
        gzip_static on;
    }

    location ~ /\.ht {
        deny all;
    }
}
```

5. Create a docker build script

```bash
# docker-build.sh
#!/bin/bash

# Run composer install
docker-compose exec app composer install

# Run migrations
docker-compose exec app php artisan migrate

# Install npm packages and build frontend assets
docker-compose exec app npm install
docker-compose exec app npm run build

# Create storage symlink
docker-compose exec app php artisan storage:link

echo "Build completed successfully!"
```

6. Make the script executable

```bash
chmod +x docker-build.sh
```

7. Test Docker environment

```bash
docker-compose up -d
./docker-build.sh
```

#### 7.2 Development Tools

1. Install Laravel Telescope for monitoring

```bash
composer require laravel/telescope --dev
php artisan telescope:install
php artisan migrate
```

2. Configure Telescope

```php
// config/telescope.php - Update the gate method in the authorization callback
'gate' => function (Illuminate\Http\Request $request) {
    return app()->environment('local') || 
        (auth()->check() && auth()->user()->email === 'admin@example.com');
},
```

3. Setup Laravel Horizon for queue monitoring (optional)

```bash
composer require laravel/horizon
php artisan horizon:install
```

### Phase 8: CI/CD with GitHub Actions

#### 8.1 GitHub Actions Setup

1. Create GitHub Actions directory

```bash
mkdir -p .github/workflows
```

2. Create CI workflow file

```yaml
# .github/workflows/ci.yml
name: CI

on:
  push:
    branches: [ main, develop ]
  pull_request:
    branches: [ main, develop ]

jobs:
  laravel-tests:
    runs-on: ubuntu-latest

    services:
      mysql:
        image: mysql:8.0
        env:
          MYSQL_ROOT_PASSWORD: password
          MYSQL_DATABASE: resume_test
        ports:
          - 3306:3306
        options: --health-cmd="mysqladmin ping" --health-interval=10s --health-timeout=5s --health-retries=3

    steps:
    - uses: shivammathur/setup-php@v2
      with:
        php-version: '8.2'
        extensions: mbstring, dom, fileinfo, mysql, gd
        coverage: xdebug

    - uses: actions/checkout@v3

    - name: Copy .env
      run: cp .env.example .env

    - name: Install composer dependencies
      run: composer install --prefer-dist --no-interaction

    - name: Generate key
      run: php artisan key:generate

    - name: Set up test database
      run: |
        echo "DB_PORT=3306" >> .env
        echo "DB_DATABASE=resume_test" >> .env
        echo "DB_USERNAME=root" >> .env
        echo "DB_PASSWORD=password" >> .env

    - name: Run database migrations
      run: php artisan migrate

    - name: Install and build frontend
      run: |
        npm install
        npm run build

    - name: Run tests
      run: php artisan test
```

3. Create deployment workflow file

```yaml
# .github/workflows/deploy.yml
name: Deploy

on:
  push:
    branches: [ main ]

jobs:
  deploy:
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v3

      - name: Set up SSH
        uses: webfactory/ssh-agent@v0.5.3
        with:
          ssh-private-key: ${{ secrets.SSH_PRIVATE_KEY }}

      - name: Deploy to production
        run: |
          ssh -o StrictHostKeyChecking=no ${{ secrets.SSH_USER }}@${{ secrets.SSH_HOST }} "cd ${{ secrets.APP_DIR }} && git pull origin main && composer install --no-dev --optimize-autoloader && npm install && npm run build && php artisan migrate --force && php artisan config:cache && php artisan route:cache && php artisan view:cache && sudo supervisorctl restart all"
```

#### 8.2 Environment Configuration

1. Configure GitHub secrets

   - Go to GitHub repository → Settings → Secrets and variables → Actions
   - Add the following secrets:
     - `SSH_PRIVATE_KEY`: Your server's SSH private key
     - `SSH_USER`: SSH username for deployment server
     - `SSH_HOST`: Hostname or IP of deployment server
     - `APP_DIR`: Directory path of application on server
2. Configure staging environment

```bash
# Create a staging branch
git checkout -b staging
git push origin staging
```

3. Setup environment-specific configs

```php
// config/app.php - Update environment detection
'env' => env('APP_ENV', 'production'),

// Different .env files for different environments
// .env.staging, .env.production, etc.
```

### Phase 9: Testing

#### 9.1 Unit and Feature Tests

1. Create model tests

```bash
php artisan make:test Models/ResumeTest --unit
```

2. Implement model test

```php
// tests/Unit/Models/ResumeTest.php
<?php

namespace Tests\Unit\Models;

use App\Models\Resume;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ResumeTest extends TestCase
{
    use RefreshDatabase;

    public function test_resume_belongs_to_a_user()
    {
        $user = User::factory()->create();
        $resume = Resume::create([
            'user_id' => $user->id,
            'original_name' => 'test-resume.pdf',
            'file_path' => 'resumes/test-resume.pdf',
            'file_type' => 'application/pdf',
            'file_size' => 12345,
            'status' => 'uploaded'
        ]);

        $this->assertInstanceOf(User::class, $resume->user);
        $this->assertEquals($user->id, $resume->user->id);
    }

    public function test_resume_has_correct_status_options()
    {
        $resume = new Resume();
        $resume->status = 'uploaded';
        $this->assertEquals('uploaded', $resume->status);
      
        $resume->status = 'processing';
        $this->assertEquals('processing', $resume->status);
      
        $resume->status = 'completed';
        $this->assertEquals('completed', $resume->status);
      
        $resume->status = 'failed';
        $this->assertEquals('failed', $resume->status);
    }
}
```

3. Create service tests

```bash
php artisan make:test Services/PDFServiceTest --unit
php artisan make:test Services/OpenAIServiceTest --unit
```

4. Create feature tests for controllers

```bash
php artisan make:test ResumeControllerTest
```

5. Implement feature test

```php
// tests/Feature/ResumeControllerTest.php
<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ResumeControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_upload_resume()
    {
        Storage::fake('public');
      
        $user = User::factory()->create();
        $file = UploadedFile::fake()->create('resume.pdf', 100);
      
        $response = $this->actingAs($user)
                         ->post(route('resumes.store'), [
                             'resume' => $file
                         ]);
                       
        $response->assertStatus(302);
        $response->assertRedirect(route('dashboard'));
        $response->assertSessionHas('success');
      
        $this->assertDatabaseHas('resumes', [
            'user_id' => $user->id,
            'original_name' => 'resume.pdf',
            'status' => 'uploaded'
        ]);
      
        // Check file was stored
        $resume = $user->resumes()->first();
        Storage::disk('public')->assertExists($resume->file_path);
    }

    public function test_unauthorized_user_cannot_access_resumes()
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();
      
        // Create a resume for the first user
        $resume = $user->resumes()->create([
            'original_name' => 'test-resume.pdf',
            'file_path' => 'resumes/test-resume.pdf',
            'file_type' => 'application/pdf',
            'file_size' => 12345,
            'status' => 'completed'
        ]);
      
        // Other user should not be able to access the resume
        $response = $this->actingAs($otherUser)
                         ->get(route('resumes.view-analysis', $resume));
                       
        $response->assertStatus(403);
    }
}
```

6. Create job tests

```bash
php artisan make:test Jobs/ProcessResumeJobTest --unit
```

#### 9.2 Performance and Security Testing

1. Create test for upload performance

```bash
php artisan make:test Performance/UploadPerformanceTest
```

2. Install security scanning tools

```bash
# Install Enlightn for security scanning
composer require --dev enlightn/enlightn

# Run security analyzer
php artisan enlightn
```

3. Set up Laravel Dusk for browser testing (optional)

```bash
composer require --dev laravel/dusk
php artisan dusk:install
php artisan dusk:chrome-driver
```

4. Create a Dusk test

```bash
php artisan dusk:make ResumeUploadTest
```

5. Create a test for OpenAI API performance

```bash
php artisan make:test Services/OpenAIPerformanceTest
```

### Phase 10: Production Deployment

#### 10.1 Production Server Setup

1. Provision a server (EC2, DigitalOcean, etc.)
2. Install required software on server

```bash
# Update system packages
sudo apt update && sudo apt upgrade -y

# Install PHP and extensions
sudo apt install -y php8.2-fpm php8.2-cli php8.2-common php8.2-mysql php8.2-zip php8.2-gd php8.2-mbstring php8.2-curl php8.2-xml php8.2-bcmath

# Install Nginx
sudo apt install -y nginx

# Install MySQL
sudo apt install -y mysql-server

# Install Composer
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer

# Install Node.js
curl -fsSL https://deb.nodesource.com/setup_18.x | sudo -E bash -
sudo apt install -y nodejs

# Install Redis
sudo apt install -y redis-server
```

3. Configure Nginx for the application

```nginx
server {
    listen 80;
    server_name yourdomain.com www.yourdomain.com;
    root /var/www/resume-optimizer/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

4. Set up SSL with Let's Encrypt

```bash
sudo apt install -y certbot python3-certbot-nginx
sudo certbot --nginx -d yourdomain.com -d www.yourdomain.com
```

5. Configure supervisor for queue workers

```conf
# /etc/supervisor/conf.d/resume-optimizer-worker.conf
[program:resume-optimizer-worker]
process_name=%(program_name)s_%(process_num)02d
command=php /var/www/resume-optimizer/artisan queue:work --sleep=3 --tries=3
autostart=true
autorestart=true
user=www-data
numprocs=2
redirect_stderr=true
stdout_logfile=/var/www/resume-optimizer/storage/logs/worker.log
```

6. Set up cron for scheduled tasks

```bash
# Add to crontab
* * * * * cd /var/www/resume-optimizer && php artisan schedule:run >> /dev/null 2>&1
```

#### 10.2 Monitoring and Analytics

1. Configure Google Analytics

```php
// resources/views/layouts/app.blade.php - Add before closing </head> tag
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-XXXXXXXXXX"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-XXXXXXXXXX');
</script>
```

2. Set up application monitoring with Laravel Telescope
3. Configure error tracking

```bash
# Install Flare for error reporting
composer require facade/flare-client-php
```

4. Create a monitoring dashboard with Filament
5. Set up automated backups

```bash
# Install Laravel Backup
composer require spatie/laravel-backup

# Publish configuration
php artisan vendor:publish --provider="Spatie\Backup\BackupServiceProvider"

# Schedule backup
# Add to App\Console\Kernel.php in the schedule method:
$schedule->command('backup:clean')->daily()->at('01:00');
$schedule->command('backup:run')->daily()->at('02:00');
```

## 🛠️ Technology Stack

- **Backend**: Laravel 10.x
- **Frontend**:
  - Tailwind CSS v3
  - Alpine.js
- **Admin Panel**: Filament v3
- **Database**: MySQL/PostgreSQL
- **AI**: OpenAI API (GPT-3.5/4)
- **PDF Processing**:
  - PDF Parser for extraction
  - DomPDF for generation
- **DevOps**:
  - Docker
  - GitHub Actions
  - Nginx

## 📝 Development Progress Tracker

- [ ] Phase 1: Project Setup and Authentication
- [ ] Phase 2: Admin Dashboard with Filament
- [ ] Phase 3: Resume Model and File Upload System
- [ ] Phase 4: AI Integration
- [ ] Phase 5: Resume Optimization and PDF Generation
- [ ] Phase 6: Filament Admin Resources
- [ ] Phase 7: Docker and Development Environment
- [ ] Phase 8: CI/CD with GitHub Actions
- [ ] Phase 9: Testing
- [ ] Phase 10: Production Deployment

## 🚀 Quick Start

1. Clone the repository

```bash
git clone https://github.com/your-username/smart-resume-optimizer.git
cd smart-resume-optimizer
```

2. Install dependencies

```bash
composer install
npm install
```

3. Set up environment variables

```bash
cp .env.example .env
php artisan key:generate
```

4. Run migrations

```bash
php artisan migrate
```

5. Build assets

```bash
npm run dev
```

6. Start the server

```bash
php artisan serve
```

7. Create an admin user

```bash
php artisan make:filament-user
```

## 📜 License

This project is licensed under the MIT License.
