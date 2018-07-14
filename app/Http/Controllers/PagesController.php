<?php

namespace App\Http\Controllers;

use App\Category;
use App\Follower;
use App\Suggestion;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Template;
use Illuminate\Support\Facades\Auth;


class PagesController extends Controller {

    public function index() {

        if (Auth::check()) {

            // USERS

            // select all confirmed users except current user order by followers and templates
            $all_users = User::where(
                array(
                    array('id', '<>', Auth::id()) ,
                    array('confirmation_token' , '=' , null)
                )
            )->withCount('followers')->orderBy('followers_count', 'desc')->withCount('templates')->orderBy('templates_count', 'desc')->get();

            // select all followings by current user

            $followings = User::find(Auth::id())->followings;

            // all_users - always following
            $users = $all_users->diff($followings)->take(10);


            // TEMPLATES : templates de mes followings -> template les plus populiares

            $followings_ids = Follower::where('follower_id' , '=' , Auth::id())->pluck('user_id')->toArray();

            $templates = Template::select('*', DB::raw('downloads * 2 + views as popularity_score'))->withCount([

                'votes as positive_votes' => function ($query) {
                    $query->where('status', 1);
                },

                'votes as negative_votes' => function ($query) {
                    $query->where('status', 0);
                }

            ])->whereIn('user_id' , $followings_ids)->orderByRaw('positive_votes_count - negative_votes_count DESC')->orderBy('popularity_score' , 'desc')->limit(10)->get();


            if ($templates->count() < 10 && Template::count() > $templates->count() ) {

                $other_templates = Template::select('*', DB::raw('downloads * 2 + views as popularity_score'))->withCount([

                    'votes as positive_votes' => function ($query) {
                        $query->where('status', 1);
                    },

                    'votes as negative_votes' => function ($query) {
                        $query->where('status', 0);
                    }

                ])->whereNotIn('user_id' , $followings_ids)->where('user_id' , '<>' , Auth::id())->orderByRaw('positive_votes_count - negative_votes_count DESC')->orderBy('popularity_score' , 'desc')->limit(Template::count() - $templates->count() )->get();


                $templates = $templates->concat($other_templates);
            }
        }
        else {

            $templates = Template::select('*', DB::raw('downloads * 2 + views as popularity_score'))->withCount([

                'votes as positive_votes' => function ($query) {
                    $query->where('status', 1);
                },

                'votes as negative_votes' => function ($query) {
                    $query->where('status', 0);
                }

            ])->orderByRaw('positive_votes_count - negative_votes_count DESC')->orderBy('popularity_score' , 'desc')->limit(10)->get();
        }

        return view('pages.index', compact('templates' , 'categories' , 'users'));

    }

    public function about() {

        return view('pages.about');

    }
    public function mentions_legales() {

        return view('pages.mentions-legales');
    }

    public function search(Request $request) {

        $q = $request->input('q');

        $templates = Template::select('*', DB::raw('downloads + views as popularity_score'))->where('name', 'like', '%'.$q.'%')->orderBy('popularity_score', 'desc')->get();
        $users = User::where('name', 'like', '%'.$q.'%')->get();

        return view('pages.search' , compact('templates' , 'users' ,'q'));
    }

    public function suggestions () {

        $suggestions = Suggestion::withCount('likes')->orderBy('likes_count', 'desc')->limit(10)->get();

        return view('pages.suggestions' , compact('suggestions'));
    }
}