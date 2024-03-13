<?php

namespace App\Http\Controllers\Admin;

use App\DTO\Supports\CreateSupportDTO;
use App\DTO\Supports\UpdateSupportDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateSupport;
use App\Models\Support;
use App\Services\SupportService;
use Illuminate\Http\Request;

class SupportController extends Controller
{

    /**
     * Implements Construct
     *
     * @param SupportService $service
     */
    public function __construct(
        protected SupportService $service
    ) {}


    /**
     * Return Supports
     *
     * @param Request $request
     * @return void
     */
    public function index(Request $request)
    {

        // $support = new Support();
        // $supports = $support->all();
        // dd($supports);

        $supports = $this->service->paginate(
            page: $request->get('page', 1),
            totalPerPage: $request->get('per_page', 6),
            filter: $request->filter,
        );

        $filters = ['filter' => $request->get('filter', '')];

        return view('admin/supports/index', compact('supports', 'filters'));
    }

    public function show(string $id)
    {
        // Support::find($id)
        // Support::where('id', $id)->first();
        // Support::where('id', '!=', $id)->first();
        if (!$support = $this->service->findOne($id)) {
            return back();
        }

        return view('admin/supports/show', compact('support'));
    }

    /**
     * Create form new doubt
     *
     * @return void
     */
    public function create()
    {
        return view('admin/supports/create');
    }

    public function store(StoreUpdateSupport $request, Support $support)
    {
        $this->service->new(
            CreateSupportDTO::makeFromRequest($request)
        );

        return redirect()
                ->route('supports.index')
                ->with('message', 'Cadastrado com sucesso!');
    }

    /**
     * Create form edit doubt
     *
     * @param string $id
     * @return void
     */
    public function edit(string $id)
    {
        // if (!$support = $support->where('id', $id)->first()) {
        if (!$support = $this->service->findOne($id)) {
            return back();
        }
        return view('admin/supports.edit', compact('support'));
    }

    /**
     * Form update doubt
     *
     * @param StoreUpdateSupport $request
     * @param Support $support
     * @param string $id
     * @return void
     */
    public function update(StoreUpdateSupport $request, Support $support, string $id)
    {
        $support = $this->service->update(
            UpdateSupportDTO::makeFromRequest($request),
        );

        if (!$support) {
            return back();
        }

        // $support->subject = $request->subject;
        // $support->body = $request->body;
        // $support->save();

        return redirect()
                ->route('supports.index')
                ->with('message', 'Atualizado com sucesso!');
    }

    /**
     * Implements delete
     *
     * @param string $id
     * @return void
     */
    public function destroy(string $id)
    {
        $this->service->delete($id);

        return redirect()
                ->route('supports.index')
                ->with('message', 'Deletado com sucesso!');
    }
}
