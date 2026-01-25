import {Head, usePage} from "@inertiajs/react";
import React from "react";

export default function Admin({children}: {children: React.ReactNode}) {
    const {title} = usePage<{ title?: string }>().props;

    return (
        <>
            <Head>
                <title>{(title || '') + ' - Your Clean Team CMS'}</title>
            </Head>

            <h4 className="font-weight-bold ml-3 text-capitalize">{title || ''}</h4>

            <div className="Your Clean Team__utils__content">
                {children}
            </div>

        </>
    );
}
