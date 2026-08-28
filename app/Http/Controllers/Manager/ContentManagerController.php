<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\NewsArticle;
use App\Models\PortfolioProject;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ContentManagerController extends Controller
{
    // ═══════════════════════════════════════════════════════════════
    //  DASHBOARD
    // ═══════════════════════════════════════════════════════════════

    public function index()
    {
        $this->authorize('viewAny', NewsArticle::class);

        $stats = [
            'total_articles'     => NewsArticle::count(),
            'published_articles' => NewsArticle::published()->count(),
            'total_projects'     => PortfolioProject::count(),
            'published_projects' => PortfolioProject::where('is_published', true)->count(),
        ];

        return view('manager.content.index', compact('stats'));
    }

    // ═══════════════════════════════════════════════════════════════
    //  NEWS ARTICLES
    // ═══════════════════════════════════════════════════════════════

    public function newsList()
    {
        $this->authorize('viewAny', NewsArticle::class);
        $articles = NewsArticle::latest()->paginate(15);
        return view('manager.content.news.index', compact('articles'));
    }

    public function newsCreate()
    {
        $this->authorize('create', NewsArticle::class);
        return view('manager.content.news.create');
    }

    public function newsStore(Request $request)
    {
        $this->authorize('create', NewsArticle::class);

        $data = $request->validate([
            'title'             => 'required|string|max:255',
            'excerpt'           => 'nullable|string|max:500',
            'body'              => 'nullable|string',
            'category'          => 'required|in:african_tech,global_tech,engineering',
            'author_name'       => 'nullable|string|max:255',
            'read_time_minutes' => 'nullable|integer|min:1|max:120',
            'is_published'      => 'boolean',
        ]);

        $data['slug']       = Str::slug($data['title']);
        $data['created_by'] = auth()->id();

        if (!empty($data['is_published'])) {
            $data['published_at'] = now();
        }

        NewsArticle::create($data);

        return redirect()->route('manager.content.news')
            ->with('success', 'Article created successfully.');
    }

    public function newsEdit(NewsArticle $article)
    {
        $this->authorize('update', $article);
        return view('manager.content.news.edit', compact('article'));
    }

    public function newsUpdate(Request $request, NewsArticle $article)
    {
        $this->authorize('update', $article);

        $data = $request->validate([
            'title'             => 'required|string|max:255',
            'excerpt'           => 'nullable|string|max:500',
            'body'              => 'nullable|string',
            'category'          => 'required|in:african_tech,global_tech,engineering',
            'author_name'       => 'nullable|string|max:255',
            'read_time_minutes' => 'nullable|integer|min:1|max:120',
            'is_published'      => 'boolean',
        ]);

        // Set published_at when first published
        if (!empty($data['is_published']) && !$article->published_at) {
            $data['published_at'] = now();
        } elseif (empty($data['is_published'])) {
            $data['published_at'] = null;
        }

        $article->update($data);

        return redirect()->route('manager.content.news')
            ->with('success', 'Article updated successfully.');
    }

    public function newsTogglePublish(NewsArticle $article)
    {
        $this->authorize('publish', $article);

        $article->update([
            'is_published' => ! $article->is_published,
            'published_at' => $article->is_published ? null : now(),
        ]);

        $status = $article->is_published ? 'published' : 'unpublished';
        return back()->with('success', "Article {$status} successfully.");
    }

    public function newsDestroy(NewsArticle $article)
    {
        $this->authorize('delete', $article);
        $article->delete();
        return redirect()->route('manager.content.news')
            ->with('success', 'Article deleted.');
    }

    // ═══════════════════════════════════════════════════════════════
    //  PORTFOLIO PROJECTS
    // ═══════════════════════════════════════════════════════════════

    public function projectsList()
    {
        $this->authorize('viewAny', PortfolioProject::class);
        $projects = PortfolioProject::orderBy('sort_order')->paginate(15);
        return view('manager.content.projects.index', compact('projects'));
    }

    public function projectsCreate()
    {
        $this->authorize('create', PortfolioProject::class);
        return view('manager.content.projects.create');
    }

    public function projectsStore(Request $request)
    {
        $this->authorize('create', PortfolioProject::class);

        $data = $request->validate([
            'title'        => 'required|string|max:255',
            'description'  => 'required|string',
            'domain'       => 'required|string|max:100',
            'sub_domain'   => 'nullable|string|max:100',
            'status'       => 'required|string|max:50',
            'status_color' => 'required|in:blue,green,amber,purple',
            'tech_stack'   => 'nullable|string',  // comma-separated
            'metric_label' => 'nullable|string|max:100',
            'metric_value' => 'nullable|string|max:100',
            'is_published' => 'boolean',
            'sort_order'   => 'nullable|integer',
        ]);

        // Convert comma-separated tech stack to array
        if (!empty($data['tech_stack'])) {
            $data['tech_stack'] = array_map('trim', explode(',', $data['tech_stack']));
        }

        $data['slug']       = Str::slug($data['title']);
        $data['created_by'] = auth()->id();

        PortfolioProject::create($data);

        return redirect()->route('manager.content.projects')
            ->with('success', 'Project created successfully.');
    }

    public function projectsEdit(PortfolioProject $project)
    {
        $this->authorize('update', $project);
        return view('manager.content.projects.edit', compact('project'));
    }

    public function projectsUpdate(Request $request, PortfolioProject $project)
    {
        $this->authorize('update', $project);

        $data = $request->validate([
            'title'        => 'required|string|max:255',
            'description'  => 'required|string',
            'domain'       => 'required|string|max:100',
            'sub_domain'   => 'nullable|string|max:100',
            'status'       => 'required|string|max:50',
            'status_color' => 'required|in:blue,green,amber,purple',
            'tech_stack'   => 'nullable|string',
            'metric_label' => 'nullable|string|max:100',
            'metric_value' => 'nullable|string|max:100',
            'is_published' => 'boolean',
            'sort_order'   => 'nullable|integer',
        ]);

        if (!empty($data['tech_stack'])) {
            $data['tech_stack'] = array_map('trim', explode(',', $data['tech_stack']));
        }

        $project->update($data);

        return redirect()->route('manager.content.projects')
            ->with('success', 'Project updated successfully.');
    }

    public function projectsDestroy(PortfolioProject $project)
    {
        $this->authorize('delete', $project);
        $project->delete();
        return redirect()->route('manager.content.projects')
            ->with('success', 'Project deleted.');
    }
}
