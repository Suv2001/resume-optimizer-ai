# ✅ Project: Smart Resume Optimizer AI (Laravel + DevOps)

Let's break it down into a clear, step-by-step roadmap:

## 🗂️ MASTER TASK LIST (Init → Build → DevOps → Deploy)

## 📅 **14-DAY DEVELOPMENT SCHEDULE**

---

## 🔸 **PHASE 1: Project Foundation & Setup**
### **📆 Day 1 (8 hours) - Monday**

#### **🌅 Morning Session (9:00 AM - 12:00 PM)**
| Time | Task | Commands | Duration | Status |
|------|------|----------|----------|--------|
| **9:00-9:30** | Create GitHub Repository | Create repo `smart-resume-optimizer` | 30 min | [ ] |
| **9:30-10:30** | Clone & Setup Laravel | `git clone`, `composer create-project laravel/laravel resume-ai` | 1 hour | [ ] |
| **10:30-11:00** | Environment Configuration | Setup `.env`, database config | 30 min | [ ] |
| **11:00-12:00** | Install Laravel Breeze | `composer require laravel/breeze --dev` | 1 hour | [ ] |

#### **🌞 Afternoon Session (1:00 PM - 5:00 PM)**
| Time | Task | Commands | Duration | Status |
|------|------|----------|----------|--------|
| **1:00-2:00** | Breeze Setup | `php artisan breeze:install blade` | 1 hour | [ ] |
| **2:00-3:00** | Frontend Dependencies | `npm install && npm run dev` | 1 hour | [ ] |
| **3:00-4:00** | Database Migration | `php artisan migrate` | 1 hour | [ ] |
| **4:00-5:00** | Initial Git Commit | `git add .`, `git commit`, `git push` | 1 hour | [ ] |

#### **🎯 Day 1 Deliverables:**
- ✅ Working Laravel app with authentication
- ✅ GitHub repository setup
- ✅ Basic Tailwind CSS styling
- ✅ User registration/login working

---

## 🔸 **PHASE 2: Core UI & File Upload System**
### **📆 Day 2-3 (16 hours) - Tuesday & Wednesday**

#### **📆 Day 2 - Tuesday (8 hours)**

##### **🌅 Morning Session (9:00 AM - 12:00 PM)**
| Time | Task | Details | Duration | Status |
|------|------|---------|----------|--------|
| **9:00-10:00** | Create Resume Model & Migration | `php artisan make:model Resume -m` | 1 hour | [ ] |
| **10:00-11:00** | Design Database Schema | Add columns: user_id, file_path, status, etc. | 1 hour | [ ] |
| **11:00-12:00** | Create Resume Controller | `php artisan make:controller ResumeController` | 1 hour | [ ] |

##### **🌞 Afternoon Session (1:00 PM - 5:00 PM)**
| Time | Task | Details | Duration | Status |
|------|------|---------|----------|--------|
| **1:00-2:30** | Build Dashboard Layout | Create dashboard.blade.php with Tailwind | 1.5 hours | [ ] |
| **2:30-4:00** | File Upload Form | HTML form with file validation | 1.5 hours | [ ] |
| **4:00-5:00** | Route Configuration | Setup web.php routes | 1 hour | [ ] |

#### **📆 Day 3 - Wednesday (8 hours)**

##### **🌅 Morning Session (9:00 AM - 12:00 PM)**
| Time | Task | Details | Duration | Status |
|------|------|---------|----------|--------|
| **9:00-10:30** | File Upload Logic | Implement file storage & validation | 1.5 hours | [ ] |
| **10:30-12:00** | File Security | Setup storage symlink, file permissions | 1.5 hours | [ ] |

##### **🌞 Afternoon Session (1:00 PM - 5:00 PM)**
| Time | Task | Details | Duration | Status |
|------|------|---------|----------|--------|
| **1:00-2:30** | Resume List View | Display uploaded resumes | 1.5 hours | [ ] |
| **2:30-4:00** | Status Management | Upload, processing, completed states | 1.5 hours | [ ] |
| **4:00-5:00** | UI Polish | Responsive design, loading states | 1 hour | [ ] |

#### **🎯 Day 2-3 Deliverables:**
- ✅ Resume upload functionality
- ✅ File storage system
- ✅ Dashboard with resume list
- ✅ Status tracking system

---

## 🔸 **PHASE 3: AI Integration & PDF Processing**
### **📆 Day 4-5 (16 hours) - Thursday & Friday**

#### **📆 Day 4 - Thursday (8 hours)**

##### **🌅 Morning Session (9:00 AM - 12:00 PM)**
| Time | Task | Commands/Details | Duration | Status |
|------|------|------------------|----------|--------|
| **9:00-10:00** | Install PDF Parser | `composer require smalot/pdfparser` | 1 hour | [ ] |
| **10:00-11:30** | Create PDF Service | Build PDFService class for text extraction | 1.5 hours | [ ] |
| **11:30-12:00** | Test PDF Extraction | Test with sample resume PDFs | 30 min | [ ] |

##### **🌞 Afternoon Session (1:00 PM - 5:00 PM)**
| Time | Task | Details | Duration | Status |
|------|------|---------|----------|--------|
| **1:00-2:00** | OpenAI Account Setup | Get API key, test basic connection | 1 hour | [ ] |
| **2:00-3:30** | Create OpenAI Service | Build service class for API calls | 1.5 hours | [ ] |
| **3:30-4:30** | Design AI Prompts | Create effective resume analysis prompts | 1 hour | [ ] |
| **4:30-5:00** | Environment Variables | Add OPENAI_API_KEY to .env | 30 min | [ ] |

#### **📆 Day 5 - Friday (8 hours)**

##### **🌅 Morning Session (9:00 AM - 12:00 PM)**
| Time | Task | Details | Duration | Status |
|------|------|---------|----------|--------|
| **9:00-10:30** | Create Job Queue | `php artisan make:job ProcessResumeJob` | 1.5 hours | [ ] |
| **10:30-12:00** | Queue Configuration | Setup Redis/database queue | 1.5 hours | [ ] |

##### **🌞 Afternoon Session (1:00 PM - 5:00 PM)**
| Time | Task | Details | Duration | Status |
|------|------|---------|----------|--------|
| **1:00-2:30** | Job Implementation | PDF extraction + AI analysis logic | 1.5 hours | [ ] |
| **2:30-4:00** | Results Display | Show AI feedback in dashboard | 1.5 hours | [ ] |
| **4:00-5:00** | Testing & Debug | Test complete flow | 1 hour | [ ] |

#### **🎯 Day 4-5 Deliverables:**
- ✅ PDF text extraction working
- ✅ OpenAI integration complete
- ✅ Background job processing
- ✅ AI feedback display

---

## 🔸 **PHASE 4: PDF Generation & Export**
### **📆 Day 6 (8 hours) - Saturday**

##### **🌅 Morning Session (9:00 AM - 12:00 PM)**
| Time | Task | Commands/Details | Duration | Status |
|------|------|------------------|----------|--------|
| **9:00-10:00** | Install DOM PDF | `composer require barryvdh/laravel-dompdf` | 1 hour | [ ] |
| **10:00-11:30** | Design Resume Template | Create professional PDF template | 1.5 hours | [ ] |
| **11:30-12:00** | Configure PDF Service | Setup PDF generation service | 30 min | [ ] |

##### **🌞 Afternoon Session (1:00 PM - 5:00 PM)**
| Time | Task | Details | Duration | Status |
|------|------|---------|----------|--------|
| **1:00-2:30** | PDF Generation Logic | Implement PDF::loadView() | 1.5 hours | [ ] |
| **2:30-3:30** | Download Routes | Create download endpoints | 1 hour | [ ] |
| **3:30-4:30** | Template Styling | CSS for PDF output | 1 hour | [ ] |
| **4:30-5:00** | Testing Downloads | Test PDF generation & downloads | 30 min | [ ] |

#### **🎯 Day 6 Deliverables:**
- ✅ PDF generation working
- ✅ Professional resume templates
- ✅ Download functionality
- ✅ Improved resume formatting

---

## 🔸 **PHASE 5: Payment Integration (Optional)**
### **📆 Day 7 (8 hours) - Sunday**

##### **🌅 Morning Session (9:00 AM - 12:00 PM)**
| Time | Task | Details | Duration | Status |
|------|------|---------|----------|--------|
| **9:00-10:00** | Razorpay Account Setup | Get test API keys | 1 hour | [ ] |
| **10:00-11:30** | Install Razorpay SDK | `composer require razorpay/razorpay` | 1.5 hours | [ ] |
| **11:30-12:00** | Payment Model & Migration | Create payment tracking | 30 min | [ ] |

##### **🌞 Afternoon Session (1:00 PM - 5:00 PM)**
| Time | Task | Details | Duration | Status |
|------|------|---------|----------|--------|
| **1:00-2:30** | Payment Controller | Handle checkout flow | 1.5 hours | [ ] |
| **2:30-4:00** | Frontend Integration | Payment buttons & forms | 1.5 hours | [ ] |
| **4:00-5:00** | Usage Restrictions | Limit free users | 1 hour | [ ] |

---

## 🔸 **PHASE 6: DevOps & Infrastructure**
### **📆 Day 8-9 (16 hours) - Monday & Tuesday**

#### **📆 Day 8 - Monday (8 hours)**

##### **🌅 Morning Session (9:00 AM - 12:00 PM)**
| Time | Task | Details | Duration | Status |
|------|------|---------|----------|--------|
| **9:00-10:30** | Create Dockerfile | Multi-stage Docker build | 1.5 hours | [ ] |
| **10:30-12:00** | Docker Compose Setup | Services: app, nginx, mysql, redis | 1.5 hours | [ ] |

##### **🌞 Afternoon Session (1:00 PM - 5:00 PM)**
| Time | Task | Details | Duration | Status |
|------|------|---------|----------|--------|
| **1:00-2:30** | Test Local Docker | `docker-compose up -d` | 1.5 hours | [ ] |
| **2:30-4:00** | Nginx Configuration | Setup nginx.conf for Laravel | 1.5 hours | [ ] |
| **4:00-5:00** | Docker Optimization | Multi-stage builds, layer caching | 1 hour | [ ] |

#### **📆 Day 9 - Tuesday (8 hours)**

##### **🌅 Morning Session (9:00 AM - 12:00 PM)**
| Time | Task | Details | Duration | Status |
|------|------|---------|----------|--------|
| **9:00-10:30** | GitHub Actions Setup | Create `.github/workflows/deploy.yml` | 1.5 hours | [ ] |
| **10:30-12:00** | CI Configuration | Linting, testing, build steps | 1.5 hours | [ ] |

##### **🌞 Afternoon Session (1:00 PM - 5:00 PM)**
| Time | Task | Details | Duration | Status |
|------|------|---------|----------|--------|
| **1:00-2:30** | GitHub Secrets | Add API keys, deploy credentials | 1.5 hours | [ ] |
| **2:30-4:00** | Deploy to Staging | Setup staging environment | 1.5 hours | [ ] |
| **4:00-5:00** | Monitoring Setup | Laravel Telescope installation | 1 hour | [ ] |

#### **🎯 Day 8-9 Deliverables:**
- ✅ Dockerized application
- ✅ CI/CD pipeline working
- ✅ Staging environment live
- ✅ Monitoring tools installed

---

## 🔸 **PHASE 7: Testing & Quality Assurance**
### **📆 Day 10-12 (24 hours) - Wednesday, Thursday, Friday**

#### **📆 Day 10 - Wednesday (8 hours)**

##### **🌅 Morning Session (9:00 AM - 12:00 PM)**
| Time | Task | Details | Duration | Status |
|------|------|---------|----------|--------|
| **9:00-10:30** | Unit Tests | Test models, services | 1.5 hours | [ ] |
| **10:30-12:00** | Feature Tests | Test complete workflows | 1.5 hours | [ ] |

##### **🌞 Afternoon Session (1:00 PM - 5:00 PM)**
| Time | Task | Details | Duration | Status |
|------|------|---------|----------|--------|
| **1:00-2:30** | Integration Tests | Test API endpoints | 1.5 hours | [ ] |
| **2:30-4:00** | Browser Tests | Laravel Dusk setup | 1.5 hours | [ ] |
| **4:00-5:00** | Test Coverage | Achieve 80%+ coverage | 1 hour | [ ] |

#### **📆 Day 11 - Thursday (8 hours)**

##### **🌅 Morning Session (9:00 AM - 12:00 PM)**
| Time | Task | Details | Duration | Status |
|------|------|---------|----------|--------|
| **9:00-11:00** | Manual Testing | Test with real resumes | 2 hours | [ ] |
| **11:00-12:00** | UI/UX Improvements | Fix responsiveness issues | 1 hour | [ ] |

##### **🌞 Afternoon Session (1:00 PM - 5:00 PM)**
| Time | Task | Details | Duration | Status |
|------|------|---------|----------|--------|
| **1:00-3:00** | Performance Testing | Load testing, optimization | 2 hours | [ ] |
| **3:00-4:00** | Security Audit | Check for vulnerabilities | 1 hour | [ ] |
| **4:00-5:00** | Bug Fixes | Address identified issues | 1 hour | [ ] |

#### **📆 Day 12 - Friday (8 hours)**

##### **🌅 Morning Session (9:00 AM - 12:00 PM)**
| Time | Task | Details | Duration | Status |
|------|------|---------|----------|--------|
| **9:00-11:00** | Google Analytics | Setup GA4 tracking | 2 hours | [ ] |
| **11:00-12:00** | SEO Optimization | Meta tags, sitemap | 1 hour | [ ] |

##### **🌞 Afternoon Session (1:00 PM - 5:00 PM)**
| Time | Task | Details | Duration | Status |
|------|------|---------|----------|--------|
| **1:00-3:00** | Documentation Update | Update README, API docs | 2 hours | [ ] |
| **3:00-4:00** | Final Code Review | Clean up, refactor | 1 hour | [ ] |
| **4:00-5:00** | Pre-launch Checklist | Final preparation | 1 hour | [ ] |

---

## 🔸 **PHASE 8: Production Launch**
### **📆 Day 13-14 (16 hours) - Saturday & Sunday**

#### **📆 Day 13 - Saturday (8 hours)**

##### **🌅 Morning Session (9:00 AM - 12:00 PM)**
| Time | Task | Details | Duration | Status |
|------|------|---------|----------|--------|
| **9:00-10:30** | Production Server Setup | EC2/DigitalOcean setup | 1.5 hours | [ ] |
| **10:30-12:00** | Domain & SSL | Configure domain, Let's Encrypt | 1.5 hours | [ ] |

##### **🌞 Afternoon Session (1:00 PM - 5:00 PM)**
| Time | Task | Details | Duration | Status |
|------|------|---------|----------|--------|
| **1:00-3:00** | Production Deployment | Deploy to production | 2 hours | [ ] |
| **3:00-4:00** | Production Testing | Test live environment | 1 hour | [ ] |
| **4:00-5:00** | Monitoring Setup | UptimeRobot, error tracking | 1 hour | [ ] |

#### **📆 Day 14 - Sunday (8 hours)**

##### **🌅 Morning Session (9:00 AM - 12:00 PM)**
| Time | Task | Details | Duration | Status |
|------|------|---------|----------|--------|
| **9:00-10:00** | Final Testing | End-to-end testing | 1 hour | [ ] |
| **10:00-11:00** | Launch Preparation | Create launch materials | 1 hour | [ ] |
| **11:00-12:00** | Soft Launch | Limited beta testing | 1 hour | [ ] |

##### **🌞 Afternoon Session (1:00 PM - 5:00 PM)**
| Time | Task | Details | Duration | Status |
|------|------|---------|----------|--------|
| **1:00-2:00** | LinkedIn Post | Write launch announcement | 1 hour | [ ] |
| **2:00-3:00** | Social Media | Share across platforms | 1 hour | [ ] |
| **3:00-4:00** | Community Sharing | WhatsApp groups, Discord | 1 hour | [ ] |
| **4:00-5:00** | Feedback Collection | Setup feedback forms | 1 hour | [ ] |

#### **🎯 Final Deliverables:**
- ✅ Live production application
- ✅ Domain with SSL certificate
- ✅ Monitoring and logging
- ✅ Launch announcement
- ✅ Feedback collection system

---

## 📊 **TIME BREAKDOWN SUMMARY**

| Phase | Days | Hours | Focus Area |
|-------|------|-------|------------|
| **Phase 1** | 1 | 8 | Project Setup & Auth |
| **Phase 2** | 2 | 16 | File Upload & UI |
| **Phase 3** | 2 | 16 | AI Integration |
| **Phase 4** | 1 | 8 | PDF Generation |
| **Phase 5** | 1 | 8 | Payment (Optional) |
| **Phase 6** | 2 | 16 | DevOps & Docker |
| **Phase 7** | 3 | 24 | Testing & QA |
| **Phase 8** | 2 | 16 | Production Launch |
| **TOTAL** | **14** | **112** | **Complete Project** |

---

## 🎯 **DAILY COMMITMENT SCHEDULE**

### **Weekdays (Mon-Fri):** 8 hours/day
- **Morning:** 9:00 AM - 12:00 PM (3 hours)
- **Afternoon:** 1:00 PM - 5:00 PM (4 hours)
- **Buffer:** 1 hour for breaks/planning

### **Weekends (Sat-Sun):** 8 hours/day
- **Morning:** 9:00 AM - 12:00 PM (3 hours)
- **Afternoon:** 1:00 PM - 5:00 PM (4 hours)
- **Evening:** Flexibility for testing/deployment

## 🧰 DevOps Learning Opportunities in This Project

Here's what you'll learn hands-on:

| Skill | Tools |
|-------|-------|
| ✅ Dockerize Laravel | Docker + docker-compose |
| ✅ Laravel CI | GitHub Actions |
| ✅ Deploy to EC2 or Render | SSH, GitHub Actions, rsync |
| ✅ Secrets Management | GitHub Secrets |
| ✅ Logs & Monitoring | Laravel Telescope, journalctl |
| ✅ Static code checks | phpstan, larastan (optional) |
| ✅ Backup (optional) | Scheduled DB backups |

---

## 📋 IN-DEPTH BREAKDOWN: Authentication to Everything

### 🔐 Authentication System (Laravel Breeze)

#### Installation & Setup
```bash
composer require laravel/breeze --dev
php artisan breeze:install blade
npm install && npm run dev
php artisan migrate
```

#### What You Get:
- **Login/Register Pages**: Pre-built with Tailwind CSS
- **Password Reset**: Email-based password recovery
- **Email Verification**: Optional email verification
- **Profile Management**: User profile editing
- **Middleware**: `auth`, `guest`, `verified` middleware

#### Customization:
```php
// routes/web.php
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/upload-resume', [ResumeController::class, 'upload'])->name('upload.resume');
});
```

### 📂 File Upload System

#### Migration for Resume Storage
```php
// database/migrations/create_resumes_table.php
Schema::create('resumes', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->string('original_name');
    $table->string('file_path');
    $table->string('file_type');
    $table->integer('file_size');
    $table->text('extracted_text')->nullable();
    $table->json('ai_feedback')->nullable();
    $table->enum('status', ['uploaded', 'processing', 'completed', 'failed']);
    $table->timestamps();
});
```

#### Resume Model
```php
// app/Models/Resume.php
class Resume extends Model
{
    protected $fillable = [
        'user_id', 'original_name', 'file_path', 
        'file_type', 'file_size', 'extracted_text', 
        'ai_feedback', 'status'
    ];

    protected $casts = [
        'ai_feedback' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
```

#### Resume Controller
```php
// app/Http/Controllers/ResumeController.php
class ResumeController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'resume' => 'required|file|mimes:pdf|max:5120' // 5MB max
        ]);

        $file = $request->file('resume');
        $filename = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('resumes', $filename, 'public');

        $resume = Resume::create([
            'user_id' => auth()->id(),
            'original_name' => $file->getClientOriginalName(),
            'file_path' => $path,
            'file_type' => $file->getClientMimeType(),
            'file_size' => $file->getSize(),
            'status' => 'uploaded'
        ]);

        // Queue for processing
        ProcessResumeJob::dispatch($resume);

        return redirect()->back()->with('success', 'Resume uploaded successfully!');
    }
}
```

### 🤖 AI Integration (OpenAI)

#### Environment Setup
```env
OPENAI_API_KEY=your_openai_api_key_here
OPENAI_MODEL=gpt-3.5-turbo
```

#### AI Service Class
```php
// app/Services/OpenAIService.php
class OpenAIService
{
    private $apiKey;
    private $model;

    public function __construct()
    {
        $this->apiKey = config('services.openai.api_key');
        $this->model = config('services.openai.model', 'gpt-3.5-turbo');
    }

    public function analyzeResume($resumeText)
    {
        $prompt = $this->buildPrompt($resumeText);
        
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type' => 'application/json',
        ])->post('https://api.openai.com/v1/chat/completions', [
            'model' => $this->model,
            'messages' => [
                [
                    'role' => 'system',
                    'content' => 'You are a professional resume reviewer and career advisor.'
                ],
                [
                    'role' => 'user',
                    'content' => $prompt
                ]
            ],
            'max_tokens' => 1500,
            'temperature' => 0.7
        ]);

        return $response->json();
    }

    private function buildPrompt($resumeText)
    {
        return "
        Please analyze this resume and provide detailed feedback in the following format:

        **STRENGTHS:**
        - List 3-5 key strengths

        **AREAS FOR IMPROVEMENT:**
        - List 3-5 specific areas that need work

        **SUGGESTIONS:**
        - Provide actionable suggestions for improvement

        **SCORE:** X/10

        Resume Content:
        {$resumeText}
        ";
    }
}
```

### 📄 PDF Processing

#### PDF Parser Setup
```bash
composer require smalot/pdfparser
```

#### PDF Service
```php
// app/Services/PDFService.php
use Smalot\PdfParser\Parser;

class PDFService
{
    public function extractText($filePath)
    {
        try {
            $parser = new Parser();
            $pdf = $parser->parseFile(storage_path('app/public/' . $filePath));
            return $pdf->getText();
        } catch (Exception $e) {
            throw new Exception('Failed to extract text from PDF: ' . $e->getMessage());
        }
    }
}
```

### 🔄 Job Queue System

#### Resume Processing Job
```php
// app/Jobs/ProcessResumeJob.php
class ProcessResumeJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $resume;

    public function __construct(Resume $resume)
    {
        $this->resume = $resume;
    }

    public function handle(PDFService $pdfService, OpenAIService $aiService)
    {
        try {
            // Update status
            $this->resume->update(['status' => 'processing']);

            // Extract text from PDF
            $extractedText = $pdfService->extractText($this->resume->file_path);
            $this->resume->update(['extracted_text' => $extractedText]);

            // Get AI feedback
            $aiResponse = $aiService->analyzeResume($extractedText);
            $this->resume->update([
                'ai_feedback' => $aiResponse['choices'][0]['message']['content'] ?? null,
                'status' => 'completed'
            ]);

        } catch (Exception $e) {
            $this->resume->update(['status' => 'failed']);
            throw $e;
        }
    }
}
```

### 🎨 Frontend (Blade + Tailwind)

#### Dashboard Layout
```blade
{{-- resources/views/dashboard.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Resume Optimizer Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Upload Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-medium mb-4">Upload Your Resume</h3>
                    
                    <form action="{{ route('upload.resume') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Resume (PDF only)</label>
                            <input type="file" name="resume" accept=".pdf" required 
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        </div>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                            Upload & Analyze
                        </button>
                    </form>
                </div>
            </div>

            <!-- Resumes List -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-medium mb-4">Your Resumes</h3>
                    
                    @forelse($resumes as $resume)
                        <div class="border rounded-lg p-4 mb-4">
                            <div class="flex justify-between items-center">
                                <div>
                                    <h4 class="font-medium">{{ $resume->original_name }}</h4>
                                    <p class="text-sm text-gray-500">
                                        Status: <span class="capitalize">{{ $resume->status }}</span>
                                    </p>
                                </div>
                                <div class="space-x-2">
                                    @if($resume->status === 'completed')
                                        <a href="{{ route('resume.view', $resume) }}" 
                                           class="bg-green-500 text-white px-3 py-1 rounded text-sm">
                                            View Results
                                        </a>
                                        <a href="{{ route('resume.download', $resume) }}" 
                                           class="bg-blue-500 text-white px-3 py-1 rounded text-sm">
                                            Download PDF
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500">No resumes uploaded yet.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
```

### 🐳 Docker Setup

#### Dockerfile
```dockerfile
FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    nodejs \
    npm

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy application files
COPY . .

# Install dependencies
RUN composer install --no-dev --optimize-autoloader
RUN npm install && npm run build

# Set permissions
RUN chown -R www-data:www-data /var/www
RUN chmod -R 755 /var/www/storage

EXPOSE 9000
CMD ["php-fpm"]
```

#### Docker Compose
```yaml
version: '3.8'

services:
  app:
    build: .
    container_name: resume-optimizer-app
    restart: unless-stopped
    working_dir: /var/www
    volumes:
      - ./:/var/www
    networks:
      - app-network

  webserver:
    image: nginx:alpine
    container_name: resume-optimizer-nginx
    restart: unless-stopped
    ports:
      - "80:80"
    volumes:
      - ./:/var/www
      - ./docker/nginx:/etc/nginx/conf.d
    networks:
      - app-network

  mysql:
    image: mysql:8.0
    container_name: resume-optimizer-mysql
    restart: unless-stopped
    environment:
      MYSQL_DATABASE: resume_optimizer
      MYSQL_ROOT_PASSWORD: password
      MYSQL_USER: laravel
      MYSQL_PASSWORD: password
    volumes:
      - mysql_data:/var/lib/mysql
    networks:
      - app-network

  redis:
    image: redis:alpine
    container_name: resume-optimizer-redis
    restart: unless-stopped
    networks:
      - app-network

networks:
  app-network:
    driver: bridge

volumes:
  mysql_data:
```

### 🚀 GitHub Actions CI/CD

#### Workflow File
```yaml
name: Deploy to Production

on:
  push:
    branches: [ main ]

jobs:
  test:
    runs-on: ubuntu-latest
    
    steps:
    - uses: actions/checkout@v3
    
    - name: Setup PHP
      uses: shivammathur/setup-php@v2
      with:
        php-version: '8.2'
        
    - name: Install Dependencies
      run: composer install --no-dev --optimize-autoloader
      
    - name: Run Tests
      run: php artisan test

  deploy:
    needs: test
    runs-on: ubuntu-latest
    
    steps:
    - uses: actions/checkout@v3
    
    - name: Deploy to Server
      uses: appleboy/ssh-action@v0.1.5
      with:
        host: ${{ secrets.HOST }}
        username: ${{ secrets.USERNAME }}
        key: ${{ secrets.SSH_KEY }}
        script: |
          cd /var/www/resume-optimizer
          git pull origin main
          composer install --no-dev --optimize-autoloader
          npm install && npm run build
          php artisan migrate --force
          php artisan config:cache
          php artisan route:cache
          php artisan view:cache
          sudo systemctl reload nginx
```

### 📊 Monitoring & Analytics

#### Laravel Telescope
```bash
composer require laravel/telescope --dev
php artisan telescope:install
php artisan migrate
```

#### Custom Analytics Dashboard
```php
// app/Http/Controllers/AnalyticsController.php
class AnalyticsController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_users' => User::count(),
            'total_resumes' => Resume::count(),
            'completed_analyses' => Resume::where('status', 'completed')->count(),
            'today_uploads' => Resume::whereDate('created_at', today())->count(),
        ];

        return view('admin.analytics', compact('stats'));
    }
}
```

This comprehensive breakdown covers every aspect of the Smart Resume Optimizer AI project, from authentication to deployment, giving you a complete roadmap for development and learning DevOps practices along the way.
